<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>

<div class="service-nav side nav">
    <?php require_once "header.html" ?>
</div>

<!-- МОДАЛЬНОЕ ОКНО С ФОРМОЙ ДЛЯ ЗАПИСИ -->
<dialog class="modal modal-bg" id="modal">
    <form class="modal-content" action="../backend/record_db.php?fileName=doctors" method="post">
        <span class="close" id="close">&times;</span>
        <div class="img-logo"><img src="img/logo-modal.png" alt=""></div>
        <div class="record">Записаться на прием</div>
        <div class="inp-block">
            <div class="name-inp">Имя</div>
            <input type="text" name="name" class="inp" pattern="[А-Я][а-я]+"
                   title="Введите имя в формате 'Ааа'" required>
        </div>
        <div class="inp-block">
            <div class="name-inp">Фамилия</div>
            <input type="text" name="surname" class="inp" pattern="[А-Я][а-я]+"
                   title="Введите фамилию в формате 'Ааа'" required>
        </div>
        <div class="inp-block">
            <div class="name-inp">Почта</div>
            <input type="text" name="email" class="inp" pattern="[a-z0-9._]+@[a-z]+\.[a-z]+"
                   title="Введите почту в формате 'ааа@ааа.ааа'" required>
        </div>
        <div class="inp-block">
            <div class="name-inp">Услуга</div>
            <select name="service" class="inp" id="select-service" onchange="updateDoctors()">
                <?php
                require_once "../backend/service_db.php";
                global $servicesData;
                ?>
                <?php foreach ($servicesData as $serviceName): ?>
                    <option name="service"><?= $serviceName ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="inp-block">
            <div class="name-inp">Специалист</div>
            <select name="doctor" class="inp" id="select-doctor">
                <?php
                require_once "../backend/doctor_db.php";
                $doctors = getDoctorListByService("Визуальная диагностика");
                ?>
                <?php foreach ($doctors as $row): ?>
                    <option><?= $row["surname"] . ' ' . mb_substr($row["name"], 0, 1) . '. ' . mb_substr($row["patronymic"], 0, 1) . '.' ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="inp-block">
            <div class="name-inp">Дата записи</div>
            <input type="date" name="date" class="inp" min="1997-01-01" max="2030-12-31" required>
        </div>
        <button type="submit" id="submit" class="btn-modal">Записаться</button>
    </form>
</dialog>

<!-- МОДАЛЬНОЕ ОКНО ПРИ УСПЕШНОЙ ЗАПИСИ -->
<dialog class="modal modal-bg2" id="modal-success">
    <div class="modal-content">
        <span class="close" id="close-success">&times;</span>
        <div class="text-modal2">Вы успешно записались на прием!</div>
    </div>
</dialog>

<!-- ОПИСАНИЕ СПЕЦИАЛИСТОВ -->
<div class="side cont-service">
    <div class="zag-srv">Наши специалисты</div>
    <div class="infa-srv">
        <div class="about">Специалисты ветеринарной клиники - это высококвалифицированные врачи и помощники, обладающие
            необходимыми знаниями и опытом для обеспечения качественного ухода за вашими питомцами. Все они – не только
            доктора, но зоопсихологи, любящие и понимающие животных.
        </div>
        <div class="img-srv"><img src="img/doctor.png" alt=""></div>
    </div>
</div>

<!-- СПИСОК ВСЕХ СПЕЦИАЛИСТОВ -->
<div class="side-doc">
    <div class="cards-doc">
        <?php global $doctorsData; ?>
        <?php foreach ($doctorsData as $row): ?>
            <div class="card-doc">
                <div class="photo-doc modal-opened">
                    <img src="img/doctors/<?php echo $row["pictureName"] ?>" alt="">
                    <img class="photo-c" src="img/bg-vrach.png" alt="">
                    <div class="quote"><i><?php echo $row["quote"] ?></i></div>
                </div>
                <div class="fio"><?php echo $row["surname"] . ' ' . $row["name"] . ' ' . $row["patronymic"] ?></div>
                <div class="doljn"><?php echo $row["description"] ?></div>
            </div>
        <?php endforeach ?>
    </div>
</div>

<button class="hidden" id="hidden-button">Записаться</button>
<div class="btn-up btn-up_hide"></div>

</body>

<?php require_once "footer.html" ?>

<!-- ОБНОВЛЕНИЕ СПИСКА СПЕЦИАЛИСТОВ В ФОРМЕ ЗАПИСИ ПРИ ИЗМЕНЕНИИ УСЛУГИ -->
<script>
    function updateDoctors() {
        let serviceName = document.getElementById("select-service");
        let service = serviceName.options[serviceName.selectedIndex].text;
        let doctorSelect = document.getElementById("select-doctor");
        doctorSelect.innerHTML = "";
        fetch("../backend/doctor_db.php?nameForSelect=" + service)
            .then(response => response.json())
            .then(data => {
                data.forEach(row => {
                    let option = document.createElement("option");
                    option.text = row["surname"] + " " + row["name"][0] + ". " + row["patronymic"][0] + ".";
                    doctorSelect.options.add(option);
                });
            });
    }
</script>

<!-- ЛОГИКА ОТКРЫТИЯ И ЗАКРЫТИЯ МОДАЛЬНЫХ ОКОН -->
<script>
    const hiddenButton = document.getElementById('hidden-button');
    const modal = document.getElementById('modal');
    const modalSuccess = document.getElementById('modal-success');
    const close = document.getElementById('close');
    const closeSuccess = document.getElementById('close-success');

    hiddenButton.addEventListener('click', () => {
        modal.style.display = 'block';
    });

    const urlParams = new URLSearchParams(location.search);
    if (urlParams.has("added")) {
        urlParams.delete("added");
        history.replaceState(null, null, location.pathname + "?" + urlParams);
        modalSuccess.style.display = 'block';
    }

    close.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    closeSuccess.addEventListener('click', () => {
        modalSuccess.style.display = 'none';
    });
</script>

<!-- ЛОГИКА ОТОБРАЖЕНИЯ СКРЫТОЙ КНОПКИ ПРИ СКРОЛЛЕ -->
<script>
    window.onscroll = function () {
        if (document.body.scrollTop > 250 || document.documentElement.scrollTop > 250) {
            hiddenButton.style.display = "block";
        } else {
            hiddenButton.style.display = "none";
        }
    };
</script>

<!-- ЛОГИКА ПЕРЕМЕЩЕНИЯ К НАЧАЛУ СТРАНИЦЫ -->
<script>
    const btnUp = {
        el: document.querySelector('.btn-up'),
        show() {
            this.el.classList.remove('btn-up_hide');
        },
        hide() {
            this.el.classList.add('btn-up_hide');
        },
        addEventListener() {
            window.addEventListener('scroll', () => {
                const scrollY = window.scrollY || document.documentElement.scrollTop;
                scrollY > 250 ? this.show() : this.hide();
            });
            this.el.onclick = () => {
                window.scrollTo({
                    top: 0,
                    left: 0,
                    behavior: 'smooth'
                });
            }
        }
    }
    btnUp.addEventListener();
</script>

</html>