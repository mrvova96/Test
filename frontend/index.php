<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>

<div class="cont_offer">
    <div class="side nav">
        <?php require_once "header.html" ?>
    </div>
    <div class="side offer">
        <div class="text-offer1">Забота <br> о вашем <br> питомце</div>
        <div class="text-offer2">Любимцы заслуживают только <br> лучшего! Доверьте заботу о <br> вашем питомце <br>
            профессионалам.
        </div>
        <button class="btn-offer" id="first-button">Записаться</button>
    </div>
</div>

<!-- МОДАЛЬНОЕ ОКНО С ФОРМОЙ ДЛЯ ЗАПИСИ -->
<dialog class="modal modal-bg" id="modal">
    <form class="modal-content" action="../backend/record_db.php?fileName=index" method="post">
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

<!-- СТРАНИЦА С ОПИСАНИЕМ -->
<div class="cont_infa">
    <div class="side text">
        <div class="text1">Наша <br> команда <br> заботится</div>
        <div class="text2">Ветеринары ВетКот - настоящие <br> профессионалы, готовые помочь вашему <br> питомцу в любой
            ситуации. <br>
            <br> Мы предлагаем широкий спектр услуг, от <br> общего осмотра до сложных операций. <br>
            <br> Доверьте нам заботу о вашем питомце, и <br> он будет в надежных руках.
        </div>
    </div>
</div>

<!-- СТРАНИЦА С АКЦИЯМИ-->
<div class="cont_mites" id="sales">
    <div class="cont_mite1" id="sale1">
        <div class="text_summer">Безопасное лето для <br> вашего питомца</div>
        <div class="usl_text_summer">
            <div class="arrow left" id="left1"><img src="img/left.png" alt=""></div>
            <div class="sale_text">В предверии активного <b><u>сезона клещей</u></b> <br> мы заботимся о здоровье и
                <br>
                безопасности ваших питомцев.<br> Приходите к нам для вакцинации <br> против клещевого энцефалита и
                других <br> болезней и получите <b><u>специальную <br> скидку!</u></b>
            </div>
            <div class="sale">
                <div class="number">20%</div>
                <div class="action">*Акция действет с 1 апреля по 1 июня</div>
            </div>
            <div class="arrow right" id="right1"><img src="img/right.png" alt=""></div>
        </div>
        <button class="btn-offer2" id="second-button">Записаться на приём</button>
    </div>
    <div class="cont_mite2" id="sale2">
        <div class="text_summer">Запишись онлайн и <br> экономь</div>
        <div class="usl_text_summer">
            <div class="arrow left" id="left2"><img src="img/left.png" alt=""></div>
            <div class="sale_text">Специальное предложение для <br> любящих хозяев! <b><u>Запишитесь</u></b> на
                приём
                <br> через <b><u>наш сайт</u></b> и получите скидку на <br> любые услуги для вашего питомца. Мы <br>
                ценим ваше доверие и заботу о <br> здоровье своего питомца. Забронируйте <br> приём сейчас и
                экономьте с
                нами!
            </div>
            <div class="sale">
                <div class="number">15%</div>
            </div>
            <div class="arrow right" id="right2"><img src="img/right.png" alt=""></div>
        </div>
        <button class="btn-offer3" id="third-button">Записаться на приём</button>
    </div>
</div>

<!-- СТРАНИЦА С УСЛУГАМИ -->
<div class="side cont_uslugi" id="services">
    <div class="zag_usl">Услуги</div>
    <div class="text_usl">Мы предоставляем своим клиентам весь спектр услуг ветеринара. Наши врачи тщательно
        соблюдают
        стандарты цивилизованной ветеринарии, строго следуют регламентам и в любой ситуации ставят интересы пациента
        на
        первое место. Наш выбор — современная доказательная медицина, основанная на научном знании.
    </div>
    <div class="uslugi">
        <div class="blok_u">
            <a href="service.php?name=Терапия"><img class="u" src="img/services/u1.png" alt=""></a>
            <a href="service.php?name=Неврология"><img class="u" src="img/services/u2.png" alt=""></a>
            <a href="service.php?name=Ортопедия"><img class="u" src="img/services/u3.png" alt=""></a>
            <a href="service.php?name=Реанимация"><img class="u" src="img/services/u4.png" alt=""></a>
        </div>
        <div class="blok_u">
            <a href="service.php?name=Груминг"><img class="u" src="img/services/u5.png" alt=""></a>
            <a href="service.php?name=Офтальмология"><img class="u" src="img/services/u6.png" alt=""></a>
            <a href="service.php?name=Стоматология"><img class="u" src="img/services/u7.png" alt=""></a>
            <a href="service.php?name=Эндоскопия"><img class="u" src="img/services/u8.png" alt=""></a>
            <a href="service.php?name=Экзотология"><img class="u" src="img/services/u9.png" alt=""></a>
        </div>
        <div class="blok_u">
            <a href="service.php?name=Хирургия"><img class="u" src="img/services/u10.png" alt=""></a>
            <a href="service.php?name=Онкология"><img class="u" src="img/services/u11.png" alt=""></a>
            <a href="service.php?name=Дерматология"><img class="u" src="img/services/u12.png" alt=""></a>
            <a href="service.php?name=Визуальная диагностика"><img class="u" src="img/services/u13.png" alt=""></a>
        </div>
        <br/>
    </div>
    <div class="cat"><img src="img/cat.png" alt=""></div>
</div>

<!-- СТРАНИЦА С ПРЕИМУЩЕСТВАМИ -->
<div class="cont_advantage" id="advantages">
    <div class="zag_adv">Наши преимущества</div>
    <div class="side advantage">
        <div class="blok_u">
            <div class="adv">
                <div class="nazv_adv">
                    <img class="img_adv" src="img/paw.png" alt="">
                    <div class="nazv_adv_text">Современное <br> оборудование</div>
                </div>
                <div class="text_adv1">В клинике "ВетКот" используется передовое ветеринарное оборудование, которое
                    позволяет проводить точную диагностику и эффективное лечение.
                </div>
            </div>
            <div class="adv">
                <div class="nazv_adv">
                    <img class="img_adv" src="img/paw.png" alt="">
                    <div class="nazv_adv_text">Комплексный <br> подход</div>
                </div>
                <div class="text_adv1">Мы предлагаем полный спектр услуг от профилактики и диагностики до лечения и
                    реабилитации, обеспечивая всесторонний уход за здоровьем вашего питомца.
                </div>
            </div>
            <div class="adv">
                <div class="nazv_adv">
                    <img class="img_adv" src="img/paw.png" alt="">
                    <div class="nazv_adv_text">Индивидуальный <br> подход</div>
                </div>
                <div class="text_adv1">Каждому животному мы уделяем максимум внимания, подбирая лечение и уход с
                    учетом
                    его индивидуальных особенностей и потребностей.
                </div>
            </div>
        </div>
        <div class="blok_u">
            <div class="adv">
                <div class="nazv_adv">
                    <img class="img_adv" src="img/paw.png" alt="">
                    <div class="nazv_adv_text">Дружелюбная <br> атмосфера</div>
                </div>
                <div class="text_adv1">В "ВетКот" мы создаем теплую и дружественную атмосферу, чтобы каждый визит был
                    комфортным как для питомцев, так и для их владельцев.
                </div>
            </div>
            <div class="adv">
                <div class="nazv_adv">
                    <img class="img_adv" src="img/paw.png" alt="">
                    <div class="nazv_adv_text">Профилактические <br> программы</div>
                </div>
                <div class="text_adv1">Наша клиника активно занимается профилактикой, предлагая различные программы
                    для
                    поддержания здоровья и благополучия животных.
                </div>
            </div>
            <div class="adv">
                <div class="nazv_adv">
                    <img class="img_adv" src="img/paw.png" alt="">
                    <div class="nazv_adv_text">Доступные <br> цены</div>
                </div>
                <div class="text_adv1">Мы предлагаем конкурентоспособные цены на все виды услуг, при этом не уменьшая
                    качество и уровень предоставляемого ухода.
                </div>
            </div>
        </div>
    </div>
</div>

<!-- СТРАНИЦА С НОВОСТЯМИ -->
<div class="cont_news" id="news">
    <div class="side">
        <div class="zag_news">Новости</div>
        <div class="news-block">
            <div class="date-news">30.04.2024</div>
            <div class="news-nazv">Открытие новой лаборатории для биохимических анализов</div>
            <div class="news-text">Ветеринарная клиника рада сообщить о современном оборудовании для точного
                диагноза
                заболеваний у вашего питомца
            </div>
            <hr>
        </div>
        <div class="news-block">
            <div class="date-news">1.04.2024</div>
            <div class="news-nazv">Конкурс красоты для питомцев: выбор лучшего пушистого друга</div>
            <div class="news-text">Приглашаем участвовать в забавном конкурсе, где вы сможете продемонстрировать
                красоту
                и уникальные черты вашего животного
            </div>
            <hr>
        </div>
        <div class="news-block">
            <div class="date-news">2.01.2024</div>
            <div class="news-nazv">Бесплатные консультации ветеринаров для владельцев собак</div>
            <div class="news-text">Наша клиника запускает акцию, в рамках которой владельцы собак смогут получить
                профессиональные советы и рекомендации по уходу за питомцем бесплатно
            </div>
            <hr>
        </div>
    </div>
</div>

<!-- СТРАНИЦА С ПОДГОТОВКОЙ -->
<div class="cont_prep">
    <div class="side prep">
        <div class="zag_prep">Как подготовить питомца к приёму?</div>
        <div class="punkt">
            <div class="num">1</div>
            <div class="punkt-text">В день визита к ветеринару не кормите животное.</div>
        </div>
        <div class="punkt">
            <div class="num">2</div>
            <div class="punkt-text">Обязательно возьмите поводок и намордник.</div>
        </div>
        <div class="punkt">
            <div class="num">3</div>
            <div class="punkt-text">Возьмите свой паспорт для составления договора. При вакцинации требуется паспорт
                питомца - мы выдадим в клинике, если у вашего питомца его еще нет.
            </div>
        </div>
        <div class="punkt">
            <div class="num">4</div>
            <div class="punkt-text">Составьте список вопросов к врачу.</div>
        </div>
        <div class="punkt">
            <div class="num">5</div>
            <div class="punkt-text">Возьмите любимое лакомство для питомца. Наши врачи с вашего разрешения смогут
                похвалить питомца за терпение натуральными лакомствами, которые есть в клинике.
            </div>
        </div>
        <button class="btn-offer4" id="fourth-button">Записаться на приём</button>
    </div>
</div>

<button class="hidden" id="hidden-button">Записаться</button>
<div class="btn-up btn-up_hide"></div>

</body>

<?php require_once "footer.html" ?>

<!-- ОБНОВЛЕНИЕ СПИСКА СПЕЦИАЛИСТОВ В ФОРМЕ ЗАПИСИ ПРИ ИЗМЕНЕНИИ УСЛУГИ -->
<script>
    function updateDoctors() {
        let serviceName = document.getElementById("select-service").value;
        let doctorSelect = document.getElementById("select-doctor");
        doctorSelect.innerHTML = "";
        fetch("../backend/doctor_db.php?nameForSelect=" + serviceName)
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
    const firstButton = document.getElementById('first-button');
    const secondButton = document.getElementById('second-button');
    const thirdButton = document.getElementById('third-button');
    const fourthButton = document.getElementById('fourth-button');
    const hiddenButton = document.getElementById('hidden-button');
    const modal = document.getElementById('modal');
    const modalSuccess = document.getElementById('modal-success');
    const close = document.getElementById('close');
    const closeSuccess = document.getElementById('close-success');

    firstButton.addEventListener('click', () => {
        modal.style.display = 'block';
    });

    secondButton.addEventListener('click', () => {
        modal.style.display = 'block';
    });

    thirdButton.addEventListener('click', () => {
        modal.style.display = 'block';
    });

    fourthButton.addEventListener('click', () => {
        modal.style.display = 'block';
    });

    hiddenButton.addEventListener('click', () => {
        modal.style.display = 'block';
    });

    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has("added")) {
        history.replaceState(null, null, location.pathname);
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

<!-- ЛОГИКА ПЕРЕКЛЮЧЕНИЯ АКЦИИ В СЛАЙДЕРЕ -->
<script>
    const sales = document.getElementById('sales');
    const right1 = document.getElementById('right1');
    const left1 = document.getElementById('left1');
    const right2 = document.getElementById('right2');
    const left2 = document.getElementById('left2');

    let slideIndex = 0;

    right1.addEventListener('click', () => {
        slideIndex++;
        if (slideIndex > 1)
            slideIndex = 0;
        sales.style.transform = 'translateX(' + (-slideIndex * 100) + '%)';
    });
    left1.addEventListener('click', () => {
        slideIndex--;
        if (slideIndex < 0)
            slideIndex = 1;
        sales.style.transform = 'translateX(' + (-slideIndex * 100) + '%)';
    });
    right2.addEventListener('click', () => {
        slideIndex++;
        if (slideIndex > 1)
            slideIndex = 0;
        sales.style.transform = 'translateX(' + (-slideIndex * 100) + '%)';
    });
    left2.addEventListener('click', () => {
        slideIndex--;
        if (slideIndex < 0)
            slideIndex = 1;
        sales.style.transform = 'translateX(' + (-slideIndex * 100) + '%)';
    });
</script>


<!--ВАРИАНТ С 2 КНОПКАМИ -->
<!--<script>-->
<!--    const sales = document.getElementById('sales');-->
<!--    const left = document.getElementById('left');-->
<!--    const right = document.getElementById('right');-->
<!--    right.addEventListener('click', () => {-->
<!--        sales.style.transform = 'translateX(-100%)';-->
<!--    });-->
<!--    left.addEventListener('click', () => {-->
<!--        sales.style.transform = 'translateX(0)';-->
<!--    });-->
<!--</script>-->

</html>