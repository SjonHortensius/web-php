<?php
$_SERVER['BASE_PAGE'] = 'releases/8_0_x_ru.php';
include_once __DIR__ . '/../include/prepend.inc';

if ($LANG === 'en') {
    mirror_redirect("/releases/8_0_x.php?lang=$LANG");
    exit();
}

if ($LANG !== 'ru' && file_exists("8_0_x_$LANG.php")) {
    mirror_redirect("/releases/8_0_x_$LANG.php?lang=$LANG");
    exit();
}

site_header("PHP 8.0.0, релиз", array(
        "current" => "php_8_0_x_ru",
        'css' => array('php8.css'),
        'meta_tags' => array(
            'og:image' => $MYSITE . 'images/php8/php_8_released.png'
        )
));
?>
<section class="php8-section php8-section_dark php8-section_header center">
  <div class="page-tools">
    <div class="change-language">
        <?php echo release_language_chooser($LANG); ?>
    </div>
  </div>
  <div class="php8-section__content">
    <div class="php8-logo">
      <img src="/images/php8/logo_php8.svg" alt="php8" height="126" width="343">
    </div>
    <div class="php8-title">релизнут!</div>
    <div class="php8-subtitle">
      PHP 8.0 — большое обновление PHP.<br class="display-none-md"> Оно содержит множество новых возможностей и
      оптимизаций, включая именованные аргументы, union type, атрибуты, constructor property promotion, выражение match,
      nullsafe оператор, JIT и улучшения в системе типов, обработке ошибок и консистентности.
    </div>
    <div class="php8-button-wrapper center">
      <a class="php8-button php8-button_light" href="#">Переходите на PHP 8!</a>
    </div>
  </div>
</section>

<section class="php8-section center">
  <div class="php8-compare">
    <h2 class="php8-h2" id="named-arguments">
      Именованные аргументы
      <a class="php8-rfc" href="https://wiki.php.net/rfc/named_params">RFC</a>
    </h2>
    <div class="php8-compare__main">
      <div class="php8-compare__block example-contents">
        <div class="php8-compare__label">PHP 7</div>
        <div class="php8-code phpcode">
          <pre>htmlspecialchars($string, ENT_COMPAT | ENT_HTML401, 'UTF-8', false);</pre>
        </div>
      </div>
      <div class="php8-compare__arrow"></div>
      <div class="php8-compare__block example-contents">
        <div class="php8-compare__label php8-compare__label_new">PHP 8</div>
        <div class="php8-code phpcode">
          <pre>htmlspecialchars($string, double_encode: false);</pre>
        </div>
      </div>
    </div>
    <div class="php8-compare__content">
      <ul>
        <li>Указывайте только необходимые параметры, пропускайте опциональные.</li>
        <li>Порядок аргументов не важен, аргументы самодокументируемы.</li>
      </ul>
    </div>
  </div>

  <div class="php8-compare">
    <h2 class="php8-h2" id="attributes">
      Атрибуты
      <a class="php8-rfc" href="https://wiki.php.net/rfc/attributes_v2">RFC</a>
    </h2>
    <div class="php8-compare__main">
      <div class="php8-compare__block example-contents">
        <div class="php8-compare__label">PHP 7</div>
        <div class="php8-code phpcode">
<pre>/**
* @Route("/api/posts/{id}", methods={"GET", "HEAD"})
*/
classUser
{</pre>
        </div>
      </div>
      <div class="php8-compare__arrow"></div>
      <div class="php8-compare__block example-contents">
        <div class="php8-compare__label php8-compare__label_new">PHP 8</div>
        <div class="php8-code phpcode">
<pre>#[Route("/api/posts/{id}", methods: ["GET", "HEAD"])]
class User
{</pre>
        </div>
      </div>
    </div>
    <div class="php8-compare__content">
      <p>Вместо аннотаций PHPDoc вы можете использовать структурные метаданные в с нативным PHP синтаксисом.</p>
    </div>
  </div>

  <div class="php8-compare">
    <h2 class="php8-h2" id="constructor-property-promotion">
      Constructor property promotion
      <a class="php8-rfc" href="https://wiki.php.net/rfc/constructor_promotion">RFC</a>
    </h2>
    <div class="php8-compare__main">
      <div class="php8-compare__block example-contents">
        <div class="php8-compare__label">PHP 7</div>
        <div class="php8-code phpcode">
<pre>class Point {
 public float $x;
 public float $y;
 public float $z;

 public function __construct(
     float $x = 0.0,
     float $y = 0.0,
     float $z = 0.0,
 ) {
     $this->x = $x;
     $this->y = $y;
     $this->z = $z;
 }
}</pre>
        </div>
      </div>
      <div class="php8-compare__arrow"></div>
      <div class="php8-compare__block example-contents">
        <div class="php8-compare__label php8-compare__label_new">PHP 8</div>
        <div class="php8-code phpcode">
<pre>class Point {
 public function __construct(
     public float $x = 0.0,
     public float $y = 0.0,
     public float $z = 0.0,
 ) {}
}</pre>
        </div>
      </div>
    </div>
    <div class="php8-compare__content">
      <p>Меньше шаблонного кода для определения и инициализации свойств.</p>
    </div>
  </div>

  <div class="php8-compare">
    <h2 class="php8-h2" id="union-types">
      Union types
      <a class="php8-rfc" href="https://wiki.php.net/rfc/union_types_v2">RFC</a>
    </h2>
    <div class="php8-compare__main">
      <div class="php8-compare__block example-contents">
        <div class="php8-compare__label">PHP 7</div>
        <div class="php8-code phpcode">
<pre>class Number {
 /** @var int|float */
 private $number;

 /**
  * @param float|int $number
  */
 public function __construct($number) {
     $this->number = $number;
 }
}

new Number('NaN'); // Ok</pre>
        </div>
      </div>
      <div class="php8-compare__arrow"></div>
      <div class="php8-compare__block example-contents">
        <div class="php8-compare__label php8-compare__label_new">PHP 8</div>
        <div class="php8-code phpcode">
<pre>class Number {
 public function __construct(
     private int|float $number
 ) {}
}

new Number('NaN'); // TypeError</pre>
        </div>
      </div>
    </div>
    <div class="php8-compare__content">
      <p>Вместо аннотаций PHPDoc для комбинации типов вы можете использовать собственные объявления union type, которые
        проверяются во время выполнения.</p>
    </div>
  </div>

  <div class="php8-compare">
    <h2 class="php8-h2" id="match-expression">
      Выражение Match
      <a class="php8-rfc" href="https://wiki.php.net/rfc/match_expression_v2">RFC</a>
    </h2>
    <div class="php8-compare__main">
      <div class="php8-compare__block example-contents">
        <div class="php8-compare__label">PHP 7</div>
        <div class="php8-code phpcode">
<pre>switch (8.0) {
 case '8.0':
   $result = "О нет!";
   break;
 case 8.0:
   $result = "То, что я и ожидал";
   break;
}
echo $result;
//> О нет!</pre>
        </div>
      </div>
      <div class="php8-compare__arrow"></div>
      <div class="php8-compare__block example-contents">
        <div class="php8-compare__label php8-compare__label_new">PHP 8</div>
        <div class="php8-code phpcode">
<pre>echo match (8.0) {
 '8.0' => "О нет!",
 8.0 => "This is what I expected",
};
//> То, что я и ожидал</pre>
        </div>
      </div>
    </div>
    <div class="php8-compare__content">
      <p>Новое выражение match похоже на оператор switch со следующими особенностями:</p>
      <ul>
        <li>Match — это выражение, его результат может быть сохранен в переменной или возвращён.</li>
        <li>Условия match поддерживают только однострочные выражения, для которых не требуется управляющая конструкция break;.</li>
        <li>Выражение match использует строге сравнение.</li>
      </ul>
    </div>
  </div>

  <div class="php8-compare">
    <h2 class="php8-h2" id="nullsafe-operator">
     Оператор Nullsafe
      <a class="php8-rfc" href="https://wiki.php.net/rfc/nullsafe_operator">RFC</a>
    </h2>
    <div class="php8-compare__main">
      <div class="php8-compare__block example-contents">
        <div class="php8-compare__label">PHP 7</div>
        <div class="php8-code phpcode">
<pre>$country =  null;

if ($session !== null) {
 $user = $session->user;

 if ($user !== null) {
     $address = $user->getAddress();

     if ($address !== null) {
         $country = $address->country;
     }
 }
}</pre>
        </div>
      </div>
      <div class="php8-compare__arrow"></div>
      <div class="php8-compare__block example-contents">
        <div class="php8-compare__label php8-compare__label_new">PHP 8</div>
        <div class="php8-code phpcode">
          <pre>$country = $session?->user?->getAddress()?->country;</pre>
        </div>
      </div>
    </div>
    <div class="php8-compare__content">
      Вместо проверки на null вы можете использовать последовательность вызовов с новым оператором Nullsafe. Когда
       один из элементов в последовательности возвращает null, выполнение прерывается и вся последовательность
        возвращает null.</p>
    </div>
  </div>

  <div class="php8-compare">
    <h2 class="php8-h2" id="saner-string-to-number-comparisons">
      Улучшенное сравнение строк и чисел
      <a class="php8-rfc" href="https://wiki.php.net/rfc/string_to_number_comparison">RFC</a>
    </h2>
    <div class="php8-compare__main">
      <div class="php8-compare__block example-contents">
        <div class="php8-compare__label">PHP 7</div>
        <div class="php8-code phpcode">
          <pre>0 == 'foobar' // true</pre>
        </div>
      </div>
      <div class="php8-compare__arrow"></div>
      <div class="php8-compare__block example-contents">
        <div class="php8-compare__label php8-compare__label_new">PHP 8</div>
        <div class="php8-code phpcode">
          <pre>0 == 'foobar' // false</pre>
        </div>
      </div>
    </div>
    <div class="php8-compare__content">
      <p>При сравнении с числовой строкой PHP 8 использует сравнение чисел. В противном случае число преобразуется в
        строку и используется сравнение строк.</p>
    </div>
  </div>

  <div class="php8-compare">
    <h2 class="php8-h2" id="consistent-type-errors-for-internal-functions">
      Ошибки согласованности типов для встроенных функций
      <a class="php8-rfc" href="https://wiki.php.net/rfc/consistent_type_errors">RFC</a>
    </h2>
    <div class="php8-compare__main">
      <div class="php8-compare__block example-contents">
        <div class="php8-compare__label">PHP 7</div>
        <div class="php8-code phpcode">
<pre>strlen([]); // Warning: strlen() expects parameter 1 to be string, array given

array_chunk([], -1); // Warning: array_chunk(): Size parameter expected to be greater than 0</pre>
        </div>
      </div>
      <div class="php8-compare__arrow"></div>
      <div class="php8-compare__block example-contents">
        <div class="php8-compare__label php8-compare__label_new">PHP 8</div>
        <div class="php8-code phpcode">
<pre>strlen([]); // TypeError: strlen(): Argument #1 ($str) must be of type string, array given

array_chunk([], -1); // ValueError: array_chunk(): Argument #2 ($length) must be greater than 0</pre>
        </div>
      </div>
    </div>
    <div class="php8-compare__content">
      <p>Большинство внутренних функций теперь выбрасывают исключение Fatal Error, если при проверке параметра возникает ошибка.</p>
    </div>
  </div>
</section>

<section class="php8-section php8-section_light">
  <h2 class="php8-h2">Компиляция Just-In-Time</h2>
  <p>
    PHP 8 представляет два механизма JIT-компиляции. Трассировка JIT, наиболее перспективная из них, на синтетических бенчмарках показывает 
    улучшение производительности примерно в 3 раза и в 1,5–2 раза на некоторых долго работающих приложениях. Стандартная 
    производительность приложения находится на одном уровне с PHP 7.4.
  </p>
  <p>
    <img src="/images/php8/jit.png" alt="Ккомпиляция Just-In-Time">
  </p>

  <h2 class="php8-h2 php8-h2_margin-top">Прочие улучшения синтаксиса</h2>
  <div class="php8-columns">
    <div class="php8-column">
      <ul>
        <li>
          Allow trailing comma in parameter list <a href="https://wiki.php.net/rfc/trailing_comma_in_parameter_list">RFC</a>
          and closure use lists <a href="https://wiki.php.net/rfc/trailing_comma_in_closure_use_list">RFC</a>.
        </li>
        <li>
          Блок catch без указания переменной <a href="https://wiki.php.net/rfc/non-capturing_catches">RFC</a>.
        </li>
        <li>
          Изменения синтаксиса переменных <a href="https://wiki.php.net/rfc/variable_syntax_tweaks">RFC</a>.
        </li>
      </ul>
    </div>
    <div class="php8-column">
      <ul>
        <li>
          Treat namespaced names as single token <a href="https://wiki.php.net/rfc/namespaced_names_as_token">RFC</a>.
        </li>
        <li>
          Выражение Throw <a href="https://wiki.php.net/rfc/throw_expression">RFC</a>.
        </li>
        <li>
          Добавление ::class для объектов <a href="https://wiki.php.net/rfc/class_name_literal_on_object">RFC</a>.
        </li>
      </ul>
    </div>
  </div>
  <div class="php8-columns">
    <div class="php8-column">
      <h2 class="php8-h2 php8-h2_margin-top">Улучшения в системе типов и обработке ошибок</h2>
      <ul>
        <li>
          Более строгие проверки типов для арифметических/побитовых операторов
          <a href="https://wiki.php.net/rfc/arithmetic_operator_type_checks">RFC</a>.
        </li>
        <li>
          Проверка методов абстрактных трейтов <a href="https://wiki.php.net/rfc/abstract_trait_method_validation">RFC</a>.
        </li>
        <li>
          Правильные сигнатуры магических методов <a href="https://wiki.php.net/rfc/magic-methods-signature">RFC</a>
        </li>
        <li>
          Реклассификация предупреждений движка <a href="https://wiki.php.net/rfc/engine_warnings">RFC</a>.
        </li>
        <li>
          Фатальная ошибка при несовместимости сигнатур методов <a href="https://wiki.php.net/rfc/lsp_errors">RFC</a>.
        </li>
        <li>
          Оператор @ больше не подавляет фатальные ошибки.
        </li>
        <li>
          Inheritance with private methods <a href="https://wiki.php.net/rfc/inheritance_private_methods">RFC</a>.
        </li>
        <li>
          Mixed type <a href="https://wiki.php.net/rfc/mixed_type_v2">RFC</a>.
        </li>
        <li>
          Возвращаемый тип static <a href="https://wiki.php.net/rfc/static_return_type">RFC</a>.
        </li>
        <li>
          Types for internal functions
          <a href="https://externals.io/message/106522">RFC</a>.
        </li>
        <li>
          Curl objects instead of resources
          <a href="https://php.watch/versions/8.0/resource-CurlHandle">RFC</a>.
        </li>
      </ul>
    </div>
    <div class="php8-column">
      <h2 class="php8-h2 php8-h2_margin-top">Новые классы, интерфейсы и функции</h2>
      <ul>
        <li>
          Класс <a href="https://wiki.php.net/rfc/weak_maps">Weak Map</a>
        </li>
        <li>
          Интерфейс <a href="https://wiki.php.net/rfc/stringable">Stringable</a>
        </li>
        <li>
          <a href="https://wiki.php.net/rfc/str_contains">str_contains()</a>,
          <a href="https://wiki.php.net/rfc/add_str_starts_with_and_ends_with_functions">str_starts_with()</a>,
          <a href="https://wiki.php.net/rfc/add_str_starts_with_and_ends_with_functions">str_ends_with()</a>
        </li>
        <li>
          <a href="https://github.com/php/php-src/pull/4769">fdiv()</a>
        </li>
        <li>
          <a href="https://wiki.php.net/rfc/get_debug_type">get_debug_type()</a>
        </li>
        <li>
          <a href="https://github.com/php/php-src/pull/5427">get_resource_id()</a>
        </li>
        <li>
          Объектно-ориентированная функция <a href="https://wiki.php.net/rfc/token_as_object">token_get_all()</a>
        </li>
      </ul>
    </div>
  </div>
</section>

<section class="php8-section php8-section_dark php8-section_footer php8-footer">
  <div class="php8-section__content">
    <h2 class="php8-h2 center">
      Бесплатное улучшение производительности.<br class="display-none-lg display-block-md">
      Улучшенный синтаксис.<br class="display-block-lg display-none-md display-block-sm">
      Повышение безопасности типов.
    </h2>
    <div class="php8-button-wrapper center">
      <a class="php8-button php8-button_light" href="#">Переходите на PHP 8!</a>
    </div>
    <div class="php8-footer__content">
      <p>
        Для загрузки исходного кода PHP 8 посетите страницу <a href="http://www.php.net/downloads">downloads</a>.
        Бинарные файлы Windows находятся на сайте <a href="http://windows.php.net/download">PHP для Windows</a>.
        Список изменений представлен в  <a href="http://www.php.net/ChangeLog-8.php">ChangeLog</a>.
      </p>
      <p>
        <a href="http://php.net/manual/ru/migration8.php">Руководство по миграции </a> доступно в разделе документация. Пожалуйста,
        изучите его для получения подробного списка новых функций и обратно несовместимых изменений.
      </p>
    </div>
  </div>
</section>




<?php site_footer();
