<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Калькулятор");
?>

<div id="app">
<section class="l-calc__section">
			<div class="l-wrapper">
				<div class="q-calc">
					<ul class="q-calc__list">
						<li class="q-calc__item">
							<span class="l-title">Вид отправки</span>
							<div class="q-calc__item-block">
								<span class="l-name">Сборная перевозка</span>
								<span class="l-icon__arrow"></span>
							</div>
							<div class="q-calc__item-content">
								<span class="">ITEM das</span>
								<span class="">ITEM das</span>
								<span class="">ITEM das</span>
							</div>
						</li>
						<li class="q-calc__item">
							<span class="l-title">Пункт отправки</span>
							<div class="q-calc__item-block">
								<span class="l-name">Город</span>
								<span class="l-icon__arrow"></span>
							</div>
							<div class="q-calc__item-content">
								<span class="">ITEM das</span>
								<span class="">ITEM das</span>
								<span class="">ITEM das</span>
							</div>
						</li>
						<li class="q-calc__item">
							<span class="l-title">Пункт прибытия</span>
							<div class="q-calc__item-block">
								<span class="l-name">Город</span>
								<span class="l-icon__arrow"></span>
							</div>
							<div class="q-calc__item-content">
								<span class="">ITEM das</span>
								<span class="">ITEM das</span>
								<span class="">ITEM das</span>
							</div>
						</li>
						<li class="q-calc__item">
							<span class="l-title">Вес</span>
							<div class="q-calc__item-block">
								<input id="ves"  value="0" type="number" hidden/>
								<label for="ves" class="l-name">100 кг</label>
							</div>
						</li>
						<li class="q-calc__item">
							<span class="l-title">Объем</span>
							<div class="q-calc__item-block">
								<input id="obem"  value="0" type="number" hidden/>
								<label for="obem" class="l-name">10 м3</label>
							</div>
						</li>
					</ul>
					<div class="l-calc__action">
						<a class="btn btn-yellow" href="javascript:void(0)">Рассчитать</a>
					</div>
				</div>
			</div>
		</section>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>