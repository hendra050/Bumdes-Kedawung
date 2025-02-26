<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Badan Usaha Milik Desa Sidomukti Kedawung</title>
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Figtree&display=swap");

            * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Figtree", sans-serif;
            }

            body {
            display: grid;
            place-content: center;
            min-height: 100vh;
            background-image: linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.9)), url("gambar/sistem/background.jpg");
            background-size: 100% 
            }

            .container {
            position: relative;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 1em;
            width: 600px;
            height: 400px;
            transition: all 400ms;
            }

            .container:hover .box {
            filter: grayscale(20%) opacity(55%);
            }

            .box {
            position: relative;
            background: var(--img) center center;
            background-size: cover;
            transition: all 400ms;
            display: flex;
            justify-content: center;
            align-items: center;
            }

            .container .box:hover {
            filter: grayscale(0%) opacity(100%);
            }

            .container:has(.box-2:hover) {
            grid-template-columns: 3fr 1fr 1fr;
            }

            .container:has(.box-3:hover) {
            grid-template-columns: 1fr 3fr 1fr;
            }

            .container:has(.box-4:hover) {
            grid-template-columns: 1fr 1fr 3fr;
            }

            .box:nth-child(odd) {
            transform: translateY(-16px);
            }

            .box:nth-child(even) {
            transform: translateY(16px);
            }

            .box::after {
            content: attr(data-text);
            position: absolute;
            bottom: 20px;
            background: #000;
            color: #fff;
            padding: 10px 10px 10px 14px;
            letter-spacing: 4px;
            text-transform: uppercase;
            transform: translateY(60px);
            opacity: 0;
            transition: all 400ms;
            }

            .box:hover::after {
            transform: translateY(0);
            opacity: 1;
            transition-delay: 100ms;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div
                class="box box-2"
                style="--img: url(https://asset.kompas.com/crops/Rb27Owiq-tuvLCuzNBIRr5Fvkrs=/421x0:3187x1844/1200x800/data/photo/2023/07/10/64ac1e00b7865.jpg)"
                data-text="Pertashop"
                onclick="window.location.href='pertashop.php'"
            ></div>
            <div
                class="box box-3"
                style="--img: url(gambar/bumdes.jpg)"
                data-text="Bumdes"
                onclick="window.location.href='bumdes.php'"
            ></div>
            <div
                class="box box-4"
                style="--img: url(https://www.pertanianku.com/wp-content/uploads/2016/08/Mengenal-Macam-macam-Jenis-Kambing-Gibas.jpg)"
                data-text="Peternakan"
                onclick="window.location.href='peternakan.php'"
            ></div>
        </div>
    </body>
</html>