<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Resep - {{ $resep->nama_masakan }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            max-width: 900px;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between; /* Menempatkan teks di kiri dan gambar di kanan */
            text-align: left;
        }

        .text-content {
            display: flex;
            flex-direction: column; /* Menyusun nama masakan dan kategori secara vertikal */
        }

        .kategori {
            color: #007bff;
            font-weight: 600;
            margin-top: 5px; /* Memberikan sedikit jarak antara nama masakan dan kategori */
        }

        .main-img {
            width: 300px;
            height: auto;
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        }
        .header h2 {
            color: #333;
            font-weight: 700;
            margin: 0;
        }
        .main-img {
            width: 300px;
            height: auto;
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        }
        p {
            color: #555;
            font-size: 16px;
        }
        h3 {
            color: #007bff;
            border-bottom: 3px solid #007bff;
            display: inline-block;
            padding-bottom: 5px;
            margin-top: 20px;
        }
        ul, ol {
            text-align: left;
            padding-left: 20px;
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.05);
        }
        li {
            margin-bottom: 8px;
            font-size: 15px;
        }
        .step-img {
            width: 30%;
            height: auto;
            border-radius: 10px;
            margin-top: 10px;
            box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.1);
        }
        .video-container {
            margin-top: 20px;
            width: 670px;
        }
        iframe {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .back-button {
            display: inline-block;
            padding: 12px 25px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin-top: 25px;
            transition: background 0.3s, transform 0.2s;
            font-weight: 600;
            font-size: 16px;
        }
        .back-button:hover {
            background: #0056b3;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<div class="container">
<div class="header">
    <div class="text-content">
        <h2>{{ $resep->nama_masakan }}</h2>
        <p class="kategori">{{ $resep->kategori }}</p>
    </div>
    <img src={{ asset('storage/' . $resep->foto_masakan) }} alt="{{ $resep->nama_masakan }}" class="main-img">
</div>


    <p>{!! $resep->deskripsi !!}</p>
    <h3>Bahan-bahan:</h3>
    <ul>
        @foreach(explode("\n", $resep->bahan) as $bahan)
            <li>{!! $bahan !!}</li>
        @endforeach
    </ul>

    <h3>Langkah-langkah:</h3>
    
    @php
        $foto_langkah = explode(',', $resep->foto_langkah);
    @endphp
    
    <ol>
        @foreach(explode("\n", $resep->cara_pengolahan) as $index => $langkah)
            <li>
                {!! $langkah !!}
                @if(isset($foto_langkah[$index]) && !empty($foto_langkah[$index]))
                    <br>
                    <img src="{{ asset('storage/' . trim($foto_langkah[$index])) }}" alt="Langkah {{ $index + 1 }}" class="step-img">
                @endif
            </li>
        @endforeach
    </ol>

    
    
    <h3>Video Tutorial:</h3>
    <div class="video-container">
        @if(str_contains($resep->link_youtube, 'youtube.com') || str_contains($resep->link_youtube, 'youtu.be'))
            <iframe height="350" 
                src="{{ str_replace(['watch?v=', 'youtu.be/'], ['embed/', 'youtube.com/embed/'], $resep->link_youtube) }}" 
                frameborder="0" allowfullscreen>
            </iframe>
        @else
            <p>Video tidak tersedia</p>
        @endif
    </div>
 
    <a href="{{ route('user.landing') }}" class="back-button">Kembali</a>
</div>

</body>
</html>

