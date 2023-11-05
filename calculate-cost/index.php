<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Калькулятор");
?>

<div id="app">
	<section class="l-calc__section">
    <div class="l-wrapper">
      <div class="q-calc">
        <ul>
        <li class="q-calc__item">
            <span>Вид отправки</span>
            <div @click="toggleDropdown(index)" class="q-calc__item-name" v-for="(option, index) in data" :key="index">{{ option.name }}</div>
            <div class="q-calc__item-content" v-if="showDropdown === index">
              <ul>
                <!-- <li v-for="item in option.items" :key="item.id">
                  {{ item.name }}
                </li> -->
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </section>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>