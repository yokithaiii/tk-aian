<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Калькулятор");
?>

<div id="app">
	<section class="l-calc__section">
    <div class="l-wrapper">
      <div class="q-calc">
        <ul>
        <li class="q-calc__item" v-for="(option, index) in data" :key="index">
            <span>Вид отправки</span>
            <div @click="toggleDropdown(index)" class="q-calc__item-name">{{ option.name }}</div>
            <div class="q-calc__item-content" v-if="showDropdown === index">
              <ul>
                <li v-for="item in option.items" :key="item.id">
                  {{ item.name }}
                  <!-- Тут можно добавить дополнительную информацию, например, tarif_kg или tarif_m3 -->
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </section>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>