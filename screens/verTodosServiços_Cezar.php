<?php
include_once("../constantes.php")
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="../assets/css/style.css">
<title>Serviços Disponíveis</title>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    .service-card {
        text-align: center;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 20px;
    }
    .service-card img {
        width: 100%;
        height: 200px; /* Defina uma altura fixa */
        border-radius: 5px;
        object-fit: cover;
    }
    .service-title {
        color: orange;
        font-weight: bold;
        margin: 10px 0;
    }
</style>
</head>
<body>
<!-- Cabeçalho com o logo e ícones -->
<?php
include_once("./header.php");
?>
<!-- Título -->
<div class="container mt-4">
<h3 class="text-center" style="color: orange;">Serviços Disponíveis</h3>
</div>
<!-- Cards de serviços -->
<div class="container">
<div class="row justify-content-center">
<!-- Corte de Cabelo -->
<div class="col-12 col-md-6 col-lg-4 service-card">
<a href="./avaliacoesComentarios.php" class="avaliacoes" style="text-decoration: none; color: inherit;">
<h4 class="service-title">Corte de Cabelo</h4>
<img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTTDtPjaS8AhK7olTWzd9UncKc4KgpMgPrwfyWE0deuwqlR_vSE" alt="Corte de Cabelo">
</a>
</div>
<!-- Manicure e Pedicure -->
<div class="col-12 col-md-6 col-lg-4 service-card">
<a href="./avaliacoesComentarios.php" class="avaliacoes" style="text-decoration: none; color: inherit;">
<h4 class="service-title">Manicure e Pedicure</h4>
<img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcS1jyIlg_LKhEcpajds4cjDtl3r7Wi7j8RVvWeKIAyqkzyH9ZqZ" alt="Manicure e Pedicure">
</a>
</div>
<!-- Barba -->
<div class="col-12 col-md-6 col-lg-4 service-card">
<a href="./avaliacoesComentarios.php" class="avaliacoes" style="text-decoration: none; color: inherit;">
<h4 class="service-title">Barba</h4>
<img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQyDwg1puNLwVU1n_FiE85VmoMwM2Zi4OlZ-2jhAhoJa04LRvOv" alt="Barba">
</a>
</div>
<!-- Design de Sobrancelha -->
<div class="col-12 col-md-6 col-lg-4 service-card">
<a href="./avaliacoesComentarios.php" class="avaliacoes" style="text-decoration: none; color: inherit;">
<h4 class="service-title">Design de Sobrancelha</h4>
<img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxMTEhUSExMWFRUXGBcXFxcXFxcXGBcXGBcXFxcXFxcYHSggGBolHRUXITEhJSkrLi4uFx8zODMtNygtLisBCgoKDg0OFxAQGi0lHR0tLS0rLS0tLS0tLS0tKy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLf/AABEIALcBEwMBIgACEQEDEQH/xAAbAAABBQEBAAAAAAAAAAAAAAACAAEDBAUGB//EAD0QAAEDAQYCCQMCBgAGAwAAAAEAAhEDBAUSITFBUWEGEyJxgZGhsdEywfAUQhVSYnLh8QcjM4KSsiRTY//EABkBAAMBAQEAAAAAAAAAAAAAAAABAgMEBf/EACQRAQEAAgEEAgIDAQAAAAAAAAABAhESAxMhMUFRImEEcZEj/9oADAMBAAIRAxEAPwD3FU71too03PO2neht1606TC9zgAFwd79IBXacWVMjLOJHFIMfpLeTHAh5dmZgAznz3C8/tLQ5xIBInV3xuti864LoAMbCSSeeeas3RcjqrgTkOGqyzz06On09+az7ruzGR2S7mch5LvbruaAJEei07sulrAMs+5agprmyrrinRswGinbTU2FOAoMICdOnASBgE8JJSgEAnhDiTtcE9ASUIcSeUaB4TEI4QkI0YCkQihMkewpIoTEIBpQoiExQDSmlIhMkZ0JSKUoBJQkmlAJIFJNKDHKcIZSBQEmJJMHJ0B5P0rvSqXOpYzhJmJTVLzeaTWlrW4RAJ2HIcVmB3XOqVHaYsu5S2QGpUAaJOnd4Lslswm3FljMs7ppXHdnWOzmDy17yvSLssAY0ACFT6PXV1bQTr3LdAWNraQgE5KSFxULMSkhc5VbTbmt1ISC5iUVa0hozIC5y13+TlSBceUfKxrTY7ZWMmR4j5Th6dLbeklJk5k8g0/fJYVt6bbMgc34vZvysV/RiqNaefECf8oWXHWbo0+oPk4JyQLrektd2fWNI/pkD/wBZR/x94Gbj4Yj7LNq2dwy6oyNojykBQupuGWCIz3Hh9RVSQrXQWbpU7cjxxAd2Ylbth6TNdrA5yfhcMXYcnMqRyIPdIMH3SFVuzwO8EHzjLuT4p5PVrNamvEtIPdmp4XmlhvCIIqRHEHzmY8F1N2dINn+YU6Pbo8KEhNRtAcJaQRyUiVxG0RSRELLvO2uYQ1uW5Ovulo7lqNFCQsP+J1eIPgFKy9X7hp8wjhU9yNYoCs8Xrxb5FELzZwIS41czxXZTKsLcw7+YKP8AUtP7h5pap7iaUiUAcnhIzoZToCUAYcilRFO0qVJUkwckmTxlwwsDAYPAartOhNyAAPIhc70duo1qmKcpz5r1W77MGNAC6s8nNhjpaYyAknKFxWNrSQiVGSk4oUtmB4lVXXa12bs/zkrwRBBoKNiY3QKyKY4JwU4KqFThgTlqaU4VSpsQVLvpvyLAVl2vovSObJY6NQTH/iZHot0FPKfhPl5je9w1aGZBe3iIEeER7LIa+R2cRjkJEcREr2R4BEHRcjfvQ9rialE4HakAw0niNgUxtxTXASYA2MDfxzHcrLapGhkf3x76eKhtQq0nFlUEuGhcCJG8EElJsHORGsaHkB/lAbV33m9jgG5nQiTiB2HJdPY77nJwgjY5H1C8+qCBiAkTnyPHDsp6NpBPh2c5Ye6fpKVipft6fTtAcua6QXg5ryG8MyC4Hnoc9fQrBsl8OZ2muJaPqaZxN3Jjx2O6u1LYKsObhPeAQdd9dz5pevY1b6Z1W8a+xPmfvzCOjeNcjX1V/qqv/wBLT3Fw+6XaGtE+Bn3U3X7XOX1L/iBtvqDUHyBU1O8STB9Wp+saNWPHhKfrKZ3I7wp/rIf3gmbagf5fUKRtYHYef+FX6th/cEhZxsR5o/P7Te38yrrQf5T4QfuiFQjdw8HKtTdUboQfBSi3VB+0HxhVvL5TrD4qVttdtU84+6lbbX8j4fCg/iM/VTnyPuh6yidacdwj2S3+j4/WS0Lwdu0eyJt5cW+qq4KWz3N8T9wU36fhXaf7g37Ql+J/n8VfF7N4H0+UlR/RO/8AzP8A3H4SRrEb6ix0auoU2hdEo6DAAiJTtOQiUBKTimUmSZMSo3OS2ciTEnxKs6tChqWsD3/PRGz0v404esxtr/PP4QPtwHnHif8AGaNji2OsS61ZYtScWpPkOLTNVIVlmfqkQtCfIuLSFZOKizRXTiqnM03AV53cys0tcPkHiOa4m87kdSMYcTOYnzO3jK7UV+aTyCIOYVcimNjzosNN0ic8sDzLT/SfDzjKdFRrMIMgBuIyAdDqcLo5CQ4agcs+4vO52vBA0M5DUd23NcleNgewZ5wcwNxMhwO2fkY45uUWM202nC7HmIjEDEiQYxcWmCJ7lau209ojONhOfAgH8nyVW86OVN08W94IkZcQQcvLgqtnrtBB2OnIbjPgdPDgqvmJniu4u6+C04HGQIz38fXyXUWWu14kQvMbXbA2owyRlDtjGI5+fstq7bxLZnLjGnIjhp69yi+FySu7dRadgqtSwMP7QgsFvDxqJGquyovk54ZNW6WnRVH3URougcUCjjGkyrn/ANIR+ckLqbhuV0BYFE+gCjQ3L7jB7XH2TGoQterYgqtSyQjllC4YX4U+u5eqRqjcFSOs6B1Mo7lHZx+DAN4D0+6SWAp0dz9Ds/t2YKSGUQKey0UISjTEIKoXhV6hVl4VOuYRTila6sQdg4YuTTlPhIPgVl1LVsTB7bDycCAfRgPc4K3bHjPQyIIOjhnkfX1XJXrUw4u0QDGZ1GEdl0k4XEAAHPMDXdpj5O+F6xX43C1znQQHNcODmOhwPOXeQVM36SaGFrnSHOIjUluQE6xJ8lylqvJrKmIwTi/5jdi6P+own6g4QHNMHLLiib0ipw0ZNfSIdScZggS0tdvOFxaZ1gLTtVE62Ltad7VjpSPi5o56dympXpWiTSMETkRpzXJ2bpdSxOD+yC4cxBIJzGohoE7yt24+lFnc0A1GggdoGeEkyRkAZz7lPasX3sb6awvgD6uydO1I91cpW0HeVWp1qNYF4LXD6W4SM41MzGx8GrLdYpOJhyP04csQ/n5N58uam4WKmUrpRaE7a65qnbHtz+ppzGxjjwKv2W8mu3g7jQqD03G1lIKqzaVbmphUT2Wl4VFXttka9pHH3+UAejxpzJPFyF+Xc5owgZTiEZZ6D1J81zzaMgGBEiZOmLX7ei9PrUQ8Z+H54rlbyuxzchpjnPhiBHqStJkni5W2sJLZ0AMd0aHxBWnYXHqSHHbI8cs54xCrWiyk1ACIynLbWTz+seSka4BgbkQZga5E/Hur2nWrWxc94ERnwHpr6Ls7vtweAvP7BTPh8A5rorqeQR3ev5Kzvtp7jrXIVBZ6+IKVxUlDykhTBBjKEtCQKUo2NInUVA+zK4UxU1UUDZgnV/Cklo9r0omlZZvFx+lh73mPQfKwb66T9U1x/wCZWwwH9S2GMnZ9TY5jKVrOnawvVxjsKldrdXAd5VarebB/MeEA5+a8ttX/ABBcP+nZwP6nuLvYD3UnRvpZXr1hTqkYYJGFoAEkA9+rd9lpejZjayx68yykd/ab3d+1kc3Z+g+Vj2y86p1e0cggrVM47R74+2ao2gbQQN9lxXKu/HGIbVa3n98d4A/0sm0205iZP5yV+s0aAZjuWeaRxBoP1OA7MxmY1V408oifclKo0VHN7Tsxk0ZnbIZ5Ku+56VOnUeabcoa0EAy46bfkLsLTdRbDm9naQJB5PHDnHlqsvpJSIYzKAXCeRggep9V0y3blsll8eXBWq6Q3I5H2nkN1To3fUeXCjTfUwRicBk3OO1tHwV0l5td9bZxCHAjYjQ+BCv8A/CzpELN19OvRqOZVIeagYXQQCCHjduc5c10dG8t7rk684a1PbjhRr0gWkuYHQ18nsOyDw2RlMQ6O5a93dKXtEVSXtyyicUaYzu0Z9nTzlLpden628XvpT1OJpYMOGAGtDiRxJB15KO1XM52Et0JiANyZ8089XLjS6dymPKOzo3pTNPrA7FMmTlPAAawqtGqKgk9kADPcujblp3krj72uavRqlppvEAYSJIh4MZ8SGv55HuV24b3ILadQcQCNcQ1kRrtPhxWOfR1Nx0dP+RuyV19K8XMPazbx4f3fK2bNa5jNcw+uCBtn358BxPHgisNpNM74SYH9J+FzXF17jsWVPzJStd+ZLMs9aVdpOUCxdpvSrUw4QomlStKaWHeV25lwH7cIjnM+/ouXtFncHencIj88F6QQCFm227ARIHP84q5kTlaJI7IOf7o1GWg71qWAlxy3gdw/NkzLr1GZ/mMZkcPstSyWSIAGf5JT2GnYKZAH5orjkNCnACNyRBlMSkEiVJlKeUJSBQYk8oU8oB0k6SA85u6zXjedQNJNKjPaLewA3fCBqddZWo6rSoWttjj/AOM2aBYTq12T3u4vLjiLuMLrhflJggPc0cGim33Dli2w2SoZwPc7WZJnyAC6curjfly4dHOeoz23aQTTNKmA0uaCQCTBImETOjILg4NIcJg6QSI08V0dO11HGWUDJ1c44QYyzghSdTanZY2UhwYPuIV3+RjrXtnP42W9705x9UFoJ1I00g7jwVCrWZplPIOJ/wALq6PRmkJLpeSSczlJ4AaK9Quumz6WNHcAuHht39yRwNOx1anZZTeRxjAPXP3WvYOjODC95l4zGZhvdOZK68UggqUp3hXMdJvUtYf6N50IngST6kfZQWy7uspupvYYdw7XiIzEZbbLWqWcTmMR5nLxGnoqlSi4/SWgg/tYyOOrgQfAStMb9s8p9OCtNz1KU4hI2cNCBx4FNZCwENdpGUbcu5dw7GZFQCJPayAjmcgdeE5rEtdy2cvBkNHIwDOctn7ZLSX5Z2XWrNoLNdVL9jWkGMh86rcuXo3OF1RkBpLgOJ4nuV64LDZaeYGfF2a6hjwdF0YzH3HJnll6rGtd3MdGJjTGkgHlv3nzXC9IOhTXYn0nFtQkmSANR9MtGm/+16faIWRa2hPK6LCbeK2Cg6g5zawcGgAOnESBJgTsOychkY71shweMojMcu7h5LpOkNyMrMeIh5Bhw1kaTxHyuYsTXNApmmZAAgaZADIlcfUu/L0ejueGpc1pJljtR7bfnJdDZ3LlabCHBxy4gfK6KyVMgsK3rUYVM1VqZVmmU4zowpmjiow1SsajQCbO3gFIxgCNrUeFMjShJRFA9BhCZOExKRkUyScIBJwmJQudCei2kxJ1UdagN0yehtQsNzTquisd3MZspaTAFOxRJo8srRtaE+FEE4C0ZosKGFMWoS1Gi2iLUJClhKFUhKdWlKqVGR8LVIUNSiClxOZMitpnrnB1w/2g6Hn/AKWa+wDINgF2dR+RfHAOdtMDkNIyXQVbGDvHqqFewuB1HqjeUP8AGsa0Hq+ywEk4YG+ZieQ3J07J4qVlvc1uKY1OR/aNz5jKFLWs7pJjl4cFUtDJDuyc2kabHX7JclcZV11+VBqQdNdp09iPBVbRfTzq3xlQVNZIOhHgdlE0S2Dn4fkIud+znTxnwnZbTU7DBB1c4wABrJP+9FUt9jYMw6XDwn4UrKHipP4a1w3HiotaTUZtJgd3rSstEhHQuqM5n0/2tOhSSFyR0mq5RYno0VaFOFUZWgDFI0J4ThOgbQjwoWKREFQvUcoqijKnZyBKcBO1isU6CD2r4U8K2LOi6mFUxRclEhZtutELYrt4Lm7fZ6pP57HdVoS7UX2szqRyGGPXNJVn2OvOUDlA+Uk/AeiNUrSoWlSNKzUmBRgqIFECnEWJQhcEgnKtICmKcpnBACUxCcBNCey0je0KJzVM4ICEtmp1KSqPorTc1ROYlaqMp9CUBswWoWITTUqZf6dJtNaTqSQs/wCfZA2pU2qzTpKYUQjAhGi2dohM5yYlMmBSnQpsSWzStKIvUAck5yWz0dzk9JkqNXbDTSnmnfETWazSrooAKw1oa2Ssi3XhwW/GYxzcrlVmrVaFRq2lZ1S0yoTWUXJpMV51VRh6pmql10qVaXgRwSVMVu9Mn5LTZapGqIFG1QtMEQQBEFUTRgoiUCSpIymJQpSjZGITJymhBgKUpFMkAkICFLKjcinAwmLURCZIwFqYonFRuKATigKRKFxS2ejlNKYlDKNnoWJNKCU0pGPEkShCFxTCWlqti7mLGs5W9ZMmzy9lXTnlHUvhDetq/b+Sudt1qDRJKe+bzDA55k7wvOLy6RPqOcfpaATA+rLY8Fdu0Y468ujtl9OzwtgcXGJ8NVl1ukca1WjOOy0nPXj6riaVeo/MvOeon7KzdtgqWisyz0i1pc7CHO0Bgkk8lePT86Tl1dTfw7ehb+sOVpaDlOQ30GakbWqTDazTkYkDODmRGwn1XH35+ns9YUrPahaWwAS1sYTo4Yh2XHu2UNGsaZxAu7syMjOm6q9OS6Tj1rZuO5baa/8ASeYBj3SXE/xm0Nya12GTGbdCZAzzy0SS7NPvx7kFI0qII2rldCdhUgULSpAVSRpk0pSmR5TEpilKCOkhLkxKY0JxUaQKGUjJzkKSRKRkExKUoXlMBcUBTFASpMiUxTFyAvSUIlCShLkwcgjkpBNKdhTB3KF7lJVcq5KVOLtjElbtv7Nn5u+6xrsZLgtu/G9hrfFa9OeLWPVvmRxlqpBwgrmbz6PNdiLSQSCDzBXXWil8LOtDCNFNaR5rUuepROYxAbjhzCtXXZyHte3PtTGvfluF3D6IcPsfULFr9HnNOOgcJ1LTp4cFrhn52y6nTlmo5Gz9GnCqC0QGv3OWuQA3yPFa1vs8VH8J9VpMrvksfSeKh0IGp2iMit24Oh7nuD62TZnBue8rfKcnNjeG9q1y9HXOoMcdwTvpJj0SXplOiAAAMgktGDMDwja8JJLzZHqWpGvHFSB4SST0WyxjikKoSST0WzdaEnVRukkg9kag4oDWHgkkjRbB1wTdaEkkaPZdYOKRqDj7pJIGzOqBRurBJJA2iNUIDVCSSlW0b6gURqJJJWHsBqIOvSSSGxtqKZrwkkqhWgqvUQcJTJIsVjfDpejzGkyVevUgnVJJdGM/5uTK3uMG10wsyvTCSSzsa41nV2QZHiiaZGSSSUXb4I2jDBMGNcs/z5WnZ70gxOfDy+Uklpj49MspL7atO9shkmSSV9zJl28fp//Z" alt="Design de Sobrancelha">
</a>
</div>
</div>
</div>

<footer>
<script src="../src/bootstrap/js/bootstrap.min.js"></script>
<?php include_once("./footer.php");?>
</footer>
</body>
</html>