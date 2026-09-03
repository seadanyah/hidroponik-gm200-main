<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class SosmedController extends Controller
{
    public function index()
    {
        $posts = DB::table('social_posts')->orderBy('created_at', 'desc')->get();
        return view('dashboard.manajemen-medsos.index', compact('posts'));
    }
    public function generate(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi' => 'nullable|string',
            'tipe' => 'required|string',
        ]);

        $imagePath = $request->file('image')->getPathname();
        $imageData = base64_encode(file_get_contents($imagePath));
        $mimeType = $request->file('image')->getMimeType();

        $prompt = "Kamu adalah social media manager expert. Buatkan caption Instagram yang menarik dan rekomendasi jam tayang (WIB) yang prime time berdasarkan gambar ini.\n";
        $prompt .= "Deskripsi tambahan: " . ($request->deskripsi ?? 'Tidak ada') . "\n";
        $prompt .= "Tipe konten: " . $request->tipe . "\n";
        $prompt .= "Berikan respons HANYA dalam format JSON murni dengan struktur: {\"caption\": \"...\", \"jam_tayang\": \"...\"}";

        $apiKey = env('GEMINI_API_KEY');
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}";
        $payload = [
            "contents" => [
                [
                    "parts" => [
                        ["text" => $prompt],
                        [
                            "inline_data" => [
                                "mime_type" => $mimeType,
                                "data" => $imageData
                            ]
                        ]
                    ]
                ]
            ],
            "generationConfig" => [
                "response_mime_type" => "application/json",
            ]
        ];

        $response = Http::timeout(30)->withoutVerifying()->post($url, $payload);
        // Parse Respons
        if ($response->successful()) {
            $result = $response->json();
            $text = $result['candidates'][0]['content']['parts'][0]['text'] ?? '{}';

            $data = json_decode($text, true);

            return response()->json([
                'success' => true,
                'caption' => $data['caption'] ?? 'Gagal membuat caption.',
                'jam_tayang' => $data['jam_tayang'] ?? 'Tidak ada rekomendasi.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal menghubungi API Gemini: ' . $response->body()
        ], 500);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi' => 'nullable|string',
            'tipe' => 'required|string',
            'caption' => 'required|string',
            'jam_tayang' => 'required|string',
        ]);

        try {
            $imagePath = $request->file('image')->store('posts', 'public');

            preg_match_all('/#\w+/u', $request->caption, $matches);
            $hashtags = implode(', ', $matches[0]);

            preg_match('/(\d{2}:\d{2})/', $request->jam_tayang, $timeMatches);
            $timeString = $timeMatches[1] ?? '12:00';

            $scheduledAt = Carbon::now()->format('Y-m-d') . ' ' . $timeString . ':00';

            if (Carbon::parse($scheduledAt)->isPast()) {
                $scheduledAt = Carbon::tomorrow()->format('Y-m-d') . ' ' . $timeString . ':00';
            }

            // 5. Insert ke Database
            $postId = DB::table('social_posts')->insertGetId([
                'title' => 'Konten ' . $request->tipe . ' - ' . Carbon::now()->format('d M'),
                'content_input' => $request->deskripsi,
                'ai_caption' => $request->caption,
                'hashtags' => $hashtags,
                'image' => $imagePath,
                'scheduled_at' => $scheduledAt,
                'status' => 'Scheduled',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Kembalikan respons sukses beserta data baru
            return response()->json([
                'success' => true,
                'message' => 'Konten berhasil disimpan dan dijadwalkan!',
                'data' => [
                    'id' => $postId,
                    'tipe' => $request->tipe,
                    'caption_potong' => \Illuminate\Support\Str::limit($request->caption, 50),
                    'caption_full' => $request->caption,
                    'image_url' => asset('storage/' . $imagePath),
                    'jadwal' => $scheduledAt,
                    'status' => 'Scheduled'
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'status' => 'required|in:draft,scheduled,posted',
        ]);

        try {
            DB::table('social_posts')
                ->where('id', $request->id)
                ->update([
                    'status' => $request->status,
                    'updated_at' => Carbon::now()
                ]);

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diperbarui!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal update status: ' . $e->getMessage()
            ], 500);
        }
    }
}
