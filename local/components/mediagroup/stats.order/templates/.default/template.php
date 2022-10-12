<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>


<!-- statistics-orders -->
<div class="statistics-orders">
  <div class="container-container">
    <!-- banner-title -->
    <div class="banner-title banner-title--second">
      <div class="banner-title__left">
        <div class="banner-title__icon">
          <span><?= count($arResult['ORDERS']) ?></span>
        </div>
        <p>Заказов</p>
      </div>
      <form class="banner-title__content" method="GET">
        <!-- dropdown-select -->

        <div class="custm_flex">

          <input type="date" name="FROM" value="<?= $_GET['FROM'] ?>" placeholder='От'>
          <input type="date" name="TO" value="<?= $_GET['TO'] ?>" placeholder='До'>
          <button type="submit" class="btn btn-light ">Применить</button>
        </div>

        <div
            class="dropdown-select dropdown-select--small dropdown-select--white j_dropdown j_naming"
            id="dropdown3"
        >
          <div class="dropdown-select__button button" data-dropdown-target="#dropdown3">
            <? if (empty($_GET['FILTER'])): ?>
              <div class="dropdown-select__button-text" data-naming="Неделя">
                Все время
              </div>
            <? else:
              if ($_GET['FILTER'] == 'week') {
                $name = 'Неделя';
              } elseif ($_GET['FILTER'] == 'month') {
                $name = 'Месяц';
              }


              ?>
              <div class="dropdown-select__button-text" data-naming="$_GET['FILTER']">
                <?= $name ?>
              </div>
            <? endif; ?>
            <div class="dropdown-select__button-icon">
              <svg class="dropdown-select__button-svg">
                <use xlink:href="#check"></use>
              </svg>
            </div>
          </div>
          <div class="dropdown-select__dropdown">
            <ul class="dropdown-select__dropdown-list" data-naming-triggers>
              <li class="dropdown-select__dropdown-item">
                <label class="radio j_closeDropdown button change_filter">
                  <input class="radio__input" type="radio" name="FILTER" value="week"/>
                  <span class="radio__text">
                                Неделя
                              </span>
                </label>
              </li>
              <li class="dropdown-select__dropdown-item">
                <label class="radio j_closeDropdown button change_filter">
                  <input class="radio__input" type="radio" name="FILTER" value="month"/>
                  <span class="radio__text">
                                Месяц
                              </span>
                </label>
              </li>
            </ul>
          </div>
        </div>
        <!-- ./ End of dropdown-select -->
      </form>
    </div>
    <!-- ./ End of banner-title -->
    <!-- statistics-orders-list -->
    <div class="statistics-orders-list">
      <?

      if (empty($_GET['ORDER'])) {
        $order_sort = 'ASC';
      }

      if ($_GET['ORDER'] == 'ASC') {
        $order_sort = 'DESC';
      }
      if ($_GET['ORDER'] == 'DESC') {
        $order_sort = 'ASC';
      }


      ?>

      <!-- statistics-orders-item -->
      <div class="statistics-orders-item">
        <div class="statistics-orders-item__header accordion-button">
          <div class="statistics-orders-item__group">
            <a class="statistics-orders-item__id">Номер заказа</a>
            <a class="statistics-orders-item__date"
               href="<? echo $APPLICATION->GetCurPageParam("SORT=DATE_INSERT&ORDER=" . $order_sort, array("SORT", 'ORDER')); ?>"
            >Дата создания заказа
              <span class="sort_custom_arrow"></span>
            </a>
          </div>
          <a class="statistics-orders-item__client"
             href="<? echo $APPLICATION->GetCurPageParam("SORT=COMPANY&ORDER=" . $order_sort, array("SORT", 'ORDER')); ?>"
          ><span>
                      	Организация
                      </span>
            <span class="sort_custom_arrow"></span>
          </a>
          <div class="statistics-orders-item__group">

            <a class="statistics-orders-item__count"
               href="<? echo $APPLICATION->GetCurPageParam("SORT=BASKET_ITEMS&ORDER=" . $order_sort, array("SORT", 'ORDER')); ?>"
            >
                        <span>
                        	Количество товаров
                        </span>
              <span class="sort_custom_arrow"></span>
            </a>
            <a class="statistics-orders-item__price"
               href="<? echo $APPLICATION->GetCurPageParam("SORT=PRICE&ORDER=" . $order_sort, array("SORT", 'ORDER')); ?>"
            >
                        <span>
                        	Сумма
                        </span>
              <span class="sort_custom_arrow"></span>
            </a>
          </div>
          <div class="statistics-orders-item__icon" style="opacity: 0"></div>
        </div>

      </div>

      <? if (empty($arResult['ORDERS'])): ?>
        Заказов не найдено
      <? endif; ?>
      <!-- ./ End of statistics-orders-item -->

      <? foreach ($arResult['ORDERS'] as $key => $order):


        $dbOrderProps = CSaleOrderPropsValue::GetList(
          array("SORT" => "ASC"),
          array("ORDER_ID" => $key, "CODE" => array("COMPANY"))
        );
        while ($arOrderProps = $dbOrderProps->GetNext()):
          $props[$arOrderProps['CODE']] = $arOrderProps['VALUE'];
        endwhile;

        ?>
        <!-- statistics-orders-item -->
        <div class="statistics-orders-item" data-accordion="<?= $key ?>">
          <div class="statistics-orders-item__header accordion-button">
            <div class="statistics-orders-item__group">
              <div class="statistics-orders-item__id"> <?= $order['ACCOUNT_NUMBER'] ?></div>
              <div class="statistics-orders-item__date"><?= $order['DATE_INSERT'] ?></div>
            </div>

            <div class="statistics-orders-item__client"><?= $props['COMPANY'] ?></div>

            <div class="statistics-orders-item__group">
              <div class="statistics-orders-item__count"><?= count($order['BASKET_ITEMS']) ?></div>
              <div class="statistics-orders-item__price"><?= $order['PRICE'] ?> руб.</div>
            </div>

            <div class="statistics-orders-item__icon"></div>
          </div>
          <div class="statistics-orders-item__content accordion-list">
            <? foreach ($order['BASKET_ITEMS'] as $keyE => $valueE): ?>

              <div class="orders-item">
                <div class="orders-item__top">
                  <h4 class="orders-item__title"><? $id_parent = $arResult['OFFERS_PRODUCTS'][$valueE['PRODUCT_ID']]['PROPERTY_CML2_LINK_VALUE'];
                    echo $arResult['PRODUCTS'][$id_parent]['PROPERTY_POLNOE_NAIMENOVANIE_VALUE']; ?></h4>
                </div>
              </div>

            <? endforeach; ?>


          </div>
        </div>
        <!-- ./ End of statistics-orders-item -->
      <? endforeach; ?>
    </div>
    <!-- ./ End of statistics-orders-list -->
    <!-- statistics-orders-bottom -->
    <div class="statistics-orders-bottom">


      <div class="statistics-orders-bottom__col">

        <div class="statistics-orders-bottom__price">
          <div class="statistics-orders-bottom__price-name">
            <p>Количество заказов</p>
          </div>
          <div class="statistics-orders-bottom__price-value">
            <p><?= count($arResult['ORDERS']) ?></p>
          </div>
        </div>

        <div class="statistics-orders-bottom__price">
          <div class="statistics-orders-bottom__price-name">
            <p>Средняя стоимость заказа</p>
          </div>
          <div class="statistics-orders-bottom__price-value">
            <p><?= $arResult['STATS']['SR_PRICE_ORDER'] ?> руб.</p>
          </div>
        </div>


        <div class="statistics-orders-bottom__price">
          <div class="statistics-orders-bottom__price-name">
            <p>Средняя стоимость товара</p>
          </div>
          <div class="statistics-orders-bottom__price-value">
            <p><?= $arResult['STATS']['SR_PRICE_PRODUCTS'] ?> руб.</p>
          </div>
        </div>
        <div class="statistics-orders-bottom__count">
          <div class="statistics-orders-bottom__count-name">
            <p>Среднее количество товаров в заказе</p>
          </div>
          <div class="statistics-orders-bottom__count-value">
            <p><?= (int)$arResult['STATS']['SR_COUNT_PRODUCTS_IN_ORDER'] ?> шт</p>
          </div>
        </div>
      </div>
      <div class="statistics-orders-bottom__col">
        <div class="statistics-orders-bottom__total-wrapper">
          <div class="statistics-orders-bottom__total">
            <div class="statistics-orders-bottom__total-name">
              <p>ИТОГО</p>
            </div>
            <div class="statistics-orders-bottom__total-value">
              <p><?= number_format($arResult['ALL_SUMM'], 2, '.', ' '); ?> руб.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ./ End of statistics-orders-bottom -->
  </div>
</div>
<!-- ./ End of statistics-orders -->

<script>
  $(document).ready(function () {

    $('.change_filter').click(function () {
      $(this).parents('form').submit();
    });


  });
</script>

          