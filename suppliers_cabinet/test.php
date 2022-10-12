<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
?>

<div class="categories">
  <div class="main-wrapper">
    <div class="main-wrapper__col">
      <table class="super-table">
        <thead class="super-table__head">
        <tr class="super-table__row">
          <td class="super-table__col">Название категории</td>
          <td class="super-table__col">Результат</td>
          <td class="super-table__col">Дополнительно</td>
          <td class="super-table__col"></td>
        </tr>
        </thead>

        <tbody class="super-table__body">
        <tr class="super-table__row">
          <td class="super-table__col">Автомобили</td>
          <td class="super-table__col">Не одобрено</td>
          <td class="super-table__col">Название категории должно быть более узконаправленным</td>
          <td class="super-table__col">
            <div class="super-table__actions super-table__actions--hidden">
              <a href="#" class="super-table__action">
                <svg class="super-table__icon">
                  <use xlink:href="#edit"></use>
                </svg>
              </a>
              <p href="#" class="super-table__action">
                <svg class="super-table__icon">
                  <use xlink:href="#trash"></use>
                </svg>
              </p>
            </div>
          </td>
        </tr>
        <tr class="super-table__row">
          <td class="super-table__col"><a href="#">Автомобильный ряд бренда КИА</a></td>
          <td class="super-table__col">Одобрено</td>
          <td class="super-table__col">23.03.2021</td>
          <td class="super-table__col">
            <div class="super-table__actions super-table__actions--hidden">
              <a href="#" class="super-table__action">
                <svg class="super-table__icon">
                  <use xlink:href="#edit"></use>
                </svg>
              </a>
              <p href="#" class="super-table__action">
                <svg class="super-table__icon">
                  <use xlink:href="#trash"></use>
                </svg>
              </p>
            </div>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
    <div class="main-wrapper__col">
      <div class="categories__actions">
        <a href="#" class="main_btn">
          <svg class="main_btn__svg">
            <use xlink:href="#sub"></use>
          </svg>
          Добавить категорию
        </a>
      </div>
    </div>
  </div>
</div>

<div class="publications">
  <div class="main-wrapper">
    <div class="main-wrapper__col">
      <table class="super-table">
        <thead class="super-table__head">
        <tr class="super-table__row">
          <td class="super-table__col">Название категории</td>
          <td class="super-table__col">Результат</td>
          <td class="super-table__col">Дополнительно</td>
          <td class="super-table__col"></td>
        </tr>
        </thead>

        <tbody class="super-table__body">
        <tr class="super-table__row">
          <td class="super-table__col">Автомобили</td>
          <td class="super-table__col super-table__col--red">Не одобрено</td>
          <td class="super-table__col">Название категории должно быть более узконаправленным</td>
          <td class="super-table__col">
            <div class="super-table__actions">
              <a href="#" class="super-table__action">
                <svg class="super-table__icon">
                  <use xlink:href="#edit"></use>
                </svg>
              </a>
              <p href="#" class="super-table__action">
                <svg class="super-table__icon">
                  <use xlink:href="#trash"></use>
                </svg>
              </p>
            </div>
          </td>
        </tr>
        <tr class="super-table__row">
          <td class="super-table__col"><a href="#">Автомобильный ряд бренда КИА</a></td>
          <td class="super-table__col">Одобрено</td>
          <td class="super-table__col">23.03.2021</td>
          <td class="super-table__col">
            <div class="super-table__actions">
              <a href="#" class="super-table__action">
                <svg class="super-table__icon">
                  <use xlink:href="#edit"></use>
                </svg>
              </a>
              <p href="#" class="super-table__action">
                <svg class="super-table__icon">
                  <use xlink:href="#trash"></use>
                </svg>
              </p>
            </div>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
    <div class="main-wrapper__col"></div>
  </div>
</div>

<div class="ebola"></div>

<div class="publications-add">
  <h6 class="title">Добавление публикации</h6>

  <div class="main-wrapper">
    <div class="main-wrapper__col">
      <form class="form">
        <div class="form__group">
          <div class="form__col">
            <label for="publicationName" class="form__label">Название публикации</label>
            <input id="publicationName" type="text" placeholder="Введите название" class="input form__input">
            <div class="form__message"></div>
            <div class="form__warning"></div>
          </div>
          <div class="form__col"></div>
        </div>

        <div class="form__group">
          <div class="form__col">
            <label class="form__label">Категория публикации</label>
            <select class="select" data-placeholder="Выберите категорию" data-select>
              <option>категория 1</option>
              <option>категория 2</option>
            </select>
            <div class="form__message"></div>
            <div class="form__warning"></div>
          </div>
          <div class="form__col"></div>
        </div>

        <div class="form__group">
          <div class="form__col">
            <label for="publicationDescription" class="form__label">Описание анонса</label>
            <?php
            $propertyID = 'PREVIEW_TEXT';
            $LHE = new CHTMLEditor;
            $LHE->Show(array(
              'name' => "PROPERTY[" . $propertyID . "][0]",
              'id' => preg_replace("/[^a-z0-9]/i", '', "PROPERTY[" . $propertyID . "][0]"),
              'inputName' => "PROPERTY[" . $propertyID . "][0]",
              'content' => $arResult["ELEMENT"][$propertyID],
              'width' => '100%',
              'minBodyWidth' => 350,
              'normalBodyWidth' => 555,
              'height' => '200',
              'bAllowPhp' => false,
              'limitPhpAccess' => false,
              'autoResize' => true,
              'autoResizeOffset' => 40,
              'useFileDialogs' => false,
              'saveOnBlur' => true,
              'showTaskbars' => false,
              'showNodeNavi' => false,
              'askBeforeUnloadPage' => true,
              'bbCode' => false,
              'siteId' => 1,
              'controlsMap' => array(
                array('id' => 'Bold', 'compact' => true, 'sort' => 80),
                array('id' => 'Italic', 'compact' => true, 'sort' => 90),
                array('id' => 'Underline', 'compact' => true, 'sort' => 100),
                array('id' => 'Strikeout', 'compact' => true, 'sort' => 110),
                array('id' => 'RemoveFormat', 'compact' => true, 'sort' => 120),
                array('id' => 'Color', 'compact' => true, 'sort' => 130),
                array('id' => 'FontSelector', 'compact' => false, 'sort' => 135),
                array('id' => 'FontSize', 'compact' => false, 'sort' => 140),
                array('separator' => true, 'compact' => false, 'sort' => 145),
                array('id' => 'OrderedList', 'compact' => true, 'sort' => 150),
                array('id' => 'UnorderedList', 'compact' => true, 'sort' => 160),
                array('id' => 'AlignList', 'compact' => false, 'sort' => 190),
                array('separator' => true, 'compact' => false, 'sort' => 200),
                array('id' => 'InsertLink', 'compact' => true, 'sort' => 210),
                array('id' => 'InsertImage', 'compact' => false, 'sort' => 220),
                array('id' => 'InsertVideo', 'compact' => true, 'sort' => 230),
                array('id' => 'InsertTable', 'compact' => false, 'sort' => 250),
                array('separator' => true, 'compact' => false, 'sort' => 290),
                array('id' => 'Fullscreen', 'compact' => false, 'sort' => 310),
                array('id' => 'More', 'compact' => true, 'sort' => 400)
              ),
            ));
            ?>
            <div class="form__message"></div>
            <div class="form__warning"></div>
          </div>
          <div class="form__col"></div>
        </div>

        <div class="form__group">
          <div class="form__col">
            <p class="form__label">Превью</p>
            <div class="form__group-list">
              <label class="file" data-file="images">
                <input class="file__input" type="file">
                <div class="file__box">
                  <div class="file__box-empty">
                    <svg class="file__icon">
                      <use xlink:href="#plus-circle"></use>
                    </svg>
                    <p class="file__text">Загрузить превью</p>
                  </div>
                  <div class="file__box-loaded" style="display:none;">
                    <img src="https://placeimg.com/640/480/any" class="file__image"/>
                    <svg class="file__delete">
                      <use xlink:href="#delete"></use>
                    </svg>
                  </div>
                </div>
              </label>
            </div>
            <div class="form__message"></div>
            <div class="form__warning"></div>
          </div>
          <div class="form__col"></div>
        </div>

        <div class="form__group">
          <div class="form__col">
            <label for="publicationText" class="form__label">Текст публикации</label>
            <?php
            $propertyID = 'PREVIEW_TEXT';
            $LHE = new CHTMLEditor;
            $LHE->Show(array(
              'name' => "PROPERTY[" . $propertyID . "][0]",
              'id' => preg_replace("/[^a-z0-9]/i", '', "PROPERTY[" . $propertyID . "][0]"),
              'inputName' => "PROPERTY[" . $propertyID . "][0]",
              'content' => $arResult["ELEMENT"][$propertyID],
              'width' => '100%',
              'minBodyWidth' => 350,
              'normalBodyWidth' => 555,
              'height' => '200',
              'bAllowPhp' => false,
              'limitPhpAccess' => false,
              'autoResize' => true,
              'autoResizeOffset' => 40,
              'useFileDialogs' => false,
              'saveOnBlur' => true,
              'showTaskbars' => false,
              'showNodeNavi' => false,
              'askBeforeUnloadPage' => true,
              'bbCode' => false,
              'siteId' => 1,
              'controlsMap' => array(
                array('id' => 'Bold', 'compact' => true, 'sort' => 80),
                array('id' => 'Italic', 'compact' => true, 'sort' => 90),
                array('id' => 'Underline', 'compact' => true, 'sort' => 100),
                array('id' => 'Strikeout', 'compact' => true, 'sort' => 110),
                array('id' => 'RemoveFormat', 'compact' => true, 'sort' => 120),
                array('id' => 'Color', 'compact' => true, 'sort' => 130),
                array('id' => 'FontSelector', 'compact' => false, 'sort' => 135),
                array('id' => 'FontSize', 'compact' => false, 'sort' => 140),
                array('separator' => true, 'compact' => false, 'sort' => 145),
                array('id' => 'OrderedList', 'compact' => true, 'sort' => 150),
                array('id' => 'UnorderedList', 'compact' => true, 'sort' => 160),
                array('id' => 'AlignList', 'compact' => false, 'sort' => 190),
                array('separator' => true, 'compact' => false, 'sort' => 200),
                array('id' => 'InsertLink', 'compact' => true, 'sort' => 210),
                array('id' => 'InsertImage', 'compact' => false, 'sort' => 220),
                array('id' => 'InsertVideo', 'compact' => true, 'sort' => 230),
                array('id' => 'InsertTable', 'compact' => false, 'sort' => 250),
                array('separator' => true, 'compact' => false, 'sort' => 290),
                array('id' => 'Fullscreen', 'compact' => false, 'sort' => 310),
                array('id' => 'More', 'compact' => true, 'sort' => 400)
              ),
            ));
            ?>
            <div class="form__message"></div>
            <div class="form__warning"></div>
          </div>
          <div class="form__col"></div>
        </div>

        <div class="form__group">
          <div class="form__col">
            <label for="publicationVideo" class="form__label">Видеоматериал</label>
            <textarea id="publicationVideo" type="text" placeholder="Вставьте iframe видео"
                      class="textarea form__textarea" data-iframe="textarea"></textarea>
            <div class="form__message"></div>
            <div class="form__warning"></div>
          </div>
          <div class="form__col">
            <div class="form__iframe" data-iframe="wrapper"></div>
          </div>
        </div>

        <div class="form__group">
          <div class="form__col">
            <label class="form__label">Фотоматериал</label>
            <div class="form__group-list">
              <label class="file" data-file="images">
                <input class="file__input" type="file">
                <div class="file__box">
                  <div class="file__box-empty">
                    <svg class="file__icon">
                      <use xlink:href="#plus-circle"></use>
                    </svg>
                    <p class="file__text">Загрузить превью</p>
                  </div>
                  <div class="file__box-loaded" style="display:none;">
                    <img src="https://placeimg.com/640/480/any" class="file__image"/>
                    <svg class="file__delete">
                      <use xlink:href="#delete"></use>
                    </svg>
                  </div>
                </div>
              </label>
              <label class="file" data-file="images">
                <input class="file__input" type="file">
                <div class="file__box">
                  <div class="file__box-empty">
                    <svg class="file__icon">
                      <use xlink:href="#plus-circle"></use>
                    </svg>
                    <p class="file__text">Загрузить превью</p>
                  </div>
                  <div class="file__box-loaded" style="display:none;">
                    <img src="https://placeimg.com/640/480/any" class="file__image"/>
                    <svg class="file__delete">
                      <use xlink:href="#delete"></use>
                    </svg>
                  </div>
                </div>
              </label>
              <label class="file" data-file="images">
                <input class="file__input" type="file">
                <div class="file__box">
                  <div class="file__box-empty">
                    <svg class="file__icon">
                      <use xlink:href="#plus-circle"></use>
                    </svg>
                    <p class="file__text">Загрузить превью</p>
                  </div>
                  <div class="file__box-loaded" style="display:none;">
                    <img src="https://placeimg.com/640/480/any" class="file__image"/>
                    <svg class="file__delete">
                      <use xlink:href="#delete"></use>
                    </svg>
                  </div>
                </div>
              </label>
              <label class="file" data-file="images">
                <input class="file__input" type="file">
                <div class="file__box">
                  <div class="file__box-empty">
                    <svg class="file__icon">
                      <use xlink:href="#plus-circle"></use>
                    </svg>
                    <p class="file__text">Загрузить превью</p>
                  </div>
                  <div class="file__box-loaded" style="display:none;">
                    <img src="https://placeimg.com/640/480/any" class="file__image"/>
                    <svg class="file__delete">
                      <use xlink:href="#delete"></use>
                    </svg>
                  </div>
                </div>
              </label>
            </div>
            <div class="form__message"></div>
            <div class="form__warning"></div>
          </div>
          <div class="form__col"></div>
        </div>
      </form>
    </div>
    <div class="main-wrapper__col"></div>
  </div>
</div>

<div class="ebola"></div>

<div class="personal">
  <h6 class="title">Личные данные</h6>

  <div class="main-wrapper">
    <div class="main-wrapper__col">
      <form class="form">
        <div class="form__group">
          <div class="form__col">
            <label for="personalName" class="form__label">Имя и фамилия</label>
            <input id="personalName" type="text" placeholder="Введите имя и фамилию" class="input form__input">
            <div class="form__message"></div>
            <div class="form__warning"></div>
          </div>
          <div class="form_col"></div>
        </div>

        <div class="form__group">
          <div class="form__col">
            <label for="personalCompany" class="form__label">Название компании</label>
            <input id="personalCompany" type="text" placeholder="Введите название" class="input form__input">
            <div class="form__message"></div>
            <div class="form__warning"></div>
          </div>
          <div class="form_col"></div>
        </div>

        <div class="form__group">
          <div class="form__col">
            <label for="personalMail" class="form__label">E-mail</label>
            <input id="personalMail" type="email" placeholder="mail@mail.ru" class="input form__input">
            <div class="form__message"></div>
            <div class="form__warning"></div>
          </div>
          <div class="form_col"></div>
        </div>

        <div class="form__group">
          <div class="form__col">
            <label for="personalPhone" class="form__label">Телефон</label>
            <input id="personalPhone" type="tel" placeholder="+7 (___) ___ __ __" class="input form__input">
            <div class="form__message"></div>
            <div class="form__warning"></div>
          </div>
          <div class="form_col"></div>
        </div>

        <div class="form__group">
          <div class="form__col">
            <label class="form__label">Изменить пароль</label>
            <input type="password" placeholder="Текущий пароль" class="input form__input">
            <input type="password" placeholder="Новый пароль" class="input form__input">
            <input type="password" placeholder="Подтвердите пароль" class="input form__input">
            <div class="form__message"></div>
            <div class="form__warning"></div>
          </div>
          <div class="form_col"></div>
        </div>

        <div class="form__actions">
          <button class="main_btn" type="submit">Сохранить изменения</button>
        </div>
      </form>
    </div>
    <div class="main-wrapper__col"></div>
  </div>
</div>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
