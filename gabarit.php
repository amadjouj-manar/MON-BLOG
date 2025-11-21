<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titre ?? 'Mon Blog' ?></title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@300;400;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #0a0a0a;
            min-height: 100vh;
            padding: 0;
            line-height: 1.6;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 50%, rgba(255, 0, 128, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(0, 255, 255, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 40% 20%, rgba(128, 0, 255, 0.1) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        #global {
            max-width: 1100px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        header {
            padding: 80px 40px 60px;
            text-align: center;
            position: relative;
            background: transparent;
        }

        header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: linear-gradient(90deg, #ff0080, #00ffff, #8000ff);
            border-radius: 2px;
        }

        header a {
            text-decoration: none;
            color: inherit;
        }

        #titreBlog {
            font-family: 'Playfair Display', serif;
            font-size: 5em;
            font-weight: 900;
            background: linear-gradient(135deg, #ff0080 0%, #00ffff 50%, #8000ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 20px;
            letter-spacing: -2px;
            transition: transform 0.3s ease;
            text-shadow: 0 0 80px rgba(255, 0, 128, 0.3);
            position: relative;
            display: inline-block;
        }

        #titreBlog::before {
            content: attr(data-text);
            position: absolute;
            left: 0;
            top: 0;
            z-index: -1;
            background: linear-gradient(135deg, #ff0080 0%, #00ffff 50%, #8000ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            filter: blur(20px);
            opacity: 0.5;
        }

        header a:hover #titreBlog {
            transform: scale(1.03);
        }

        header p {
            font-size: 1.2em;
            color: #a0a0a0;
            font-weight: 300;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        #contenu {
            padding: 60px 40px 80px;
            min-height: 400px;
        }

        /* Styles pour les articles */
        article {
            background: rgba(20, 20, 20, 0.6);
            backdrop-filter: blur(20px);
            padding: 40px;
            margin-bottom: 40px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        article::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 0, 128, 0.1) 0%, rgba(0, 255, 255, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
            pointer-events: none;
        }

        article:hover {
            transform: translateY(-8px);
            border-color: rgba(255, 0, 128, 0.3);
            box-shadow: 
                0 20px 60px rgba(0, 0, 0, 0.5),
                0 0 0 1px rgba(255, 0, 128, 0.2),
                inset 0 0 60px rgba(255, 0, 128, 0.05);
        }

        article:hover::before {
            opacity: 1;
        }

        article header {
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: transparent;
            padding-top: 0;
            position: relative;
            z-index: 1;
        }

        .titreBillet {
            font-family: 'Playfair Display', serif;
            color: #ffffff;
            margin-bottom: 12px;
            font-size: 2.2em;
            font-weight: 700;
            line-height: 1.2;
            transition: all 0.3s ease;
            position: relative;
        }

        article:hover .titreBillet {
            color: #00ffff;
            text-shadow: 0 0 30px rgba(0, 255, 255, 0.5);
        }

        article time {
            display: inline-block;
            color: #888;
            font-size: 0.85em;
            font-weight: 400;
            letter-spacing: 1px;
            text-transform: uppercase;
            position: relative;
            z-index: 1;
        }

        article p {
            color: #c0c0c0;
            font-size: 1.1em;
            line-height: 1.9;
            margin-bottom: 15px;
            font-weight: 300;
            position: relative;
            z-index: 1;
        }

        hr {
            border: none;
            height: 1px;
            background: linear-gradient(
                90deg, 
                transparent, 
                rgba(255, 0, 128, 0.3) 20%, 
                rgba(0, 255, 255, 0.3) 50%,
                rgba(128, 0, 255, 0.3) 80%,
                transparent
            );
            margin: 50px 0;
            position: relative;
        }

        hr::after {
            content: '◆';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #00ffff;
            background: #0a0a0a;
            padding: 0 15px;
            font-size: 12px;
        }

        #piedBlog {
            background: rgba(10, 10, 10, 0.8);
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #666;
            text-align: center;
            padding: 40px;
            font-size: 0.9em;
            letter-spacing: 1px;
            margin-top: 60px;
        }

        /* Animation de chargement */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        article {
            animation: fadeInUp 0.6s ease-out backwards;
        }

        article:nth-child(1) { animation-delay: 0.1s; }
        article:nth-child(2) { animation-delay: 0.2s; }
        article:nth-child(3) { animation-delay: 0.3s; }
        article:nth-child(4) { animation-delay: 0.4s; }
        article:nth-child(5) { animation-delay: 0.5s; }

        @media (max-width: 768px) {
            body {
                padding: 0;
            }

            #titreBlog {
                font-size: 3em;
            }

            header, #contenu, #piedBlog {
                padding: 40px 20px;
            }

            .titreBillet {
                font-size: 1.8em;
            }

            article {
                padding: 30px 25px;
            }

            article p {
                font-size: 1em;
            }
        }

        /* Effet de particules subtil */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        /* Scrollbar personnalisée */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #0a0a0a;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #ff0080, #00ffff);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #00ffff, #8000ff);
        }
    </style>
</head>
<body>
    <div id="global">
        <header>
            <a href="index.php">
                <h1 id="titreBlog">Mon Blog</h1>
            </a>
            <p>Je vous souhaite la bienvenue</p>
        </header>
        
        <div id="contenu">
            <?= $contenu ?>
        </div>
        
        <footer id="piedBlog">
            Blog réalisé avec PHP, HTML5 et CSS • © 2025
        </footer>
    </div>
</body>
</html>