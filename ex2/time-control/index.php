<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оценка производительности");
?>
<div>
	 [ex2-88] Оценить скорость работы сайта – страницы и созданный простой компонент «Каталог товаров» <br>
	 Самая ресурсоемкая страница: <a href="http://corp.vi.dev.it-buro.ru/bitrix/admin/perfmon_hit_grouped.php?find_is_admin=N&set_filter=Y&lang=ru">/products/index.php</a> <br>
	 Нагрузка: 15.73%
    <br>
    Кеш: 18 КБ
    <br>
    Кеш: 41 КБ
</div>

<div>
    [ex2-10] Оценить скорость работы сайта – найти самую долгую страницу и самый долгий компонент <br>
    Самая ресурсоемкая страница: <a href="http://corp.vi.dev.it-buro.ru/bitrix/admin/perfmon_hit_grouped.php?find_is_admin=N&set_filter=Y&lang=ru">/products/index.php</a> <br>
    Нагрузка: 15.73%
</div>
<div>
    bitrix:catalog: 0.0956
    bitrix:catalog: 0.0182
    bitrix:catalog: 0.0187
</div>

<div>
    [ex2-10] Оценить скорость работы сайта – найти самую долгую страницу и самый долгий компонент <br>
    Самая ресурсоемкая страница: <a href="http://corp.vi.dev.it-buro.ru/bitrix/admin/perfmon_hit_grouped.php?find_is_admin=N&set_filter=Y&lang=ru">/products/index.php</a> <br>
    Нагрузка: 15.73%
</div>
<div>
    bitrix:catalog.section: 9
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>