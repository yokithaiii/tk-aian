<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Калькулятор");
?>

<div id="app">
<section class="l-calc__section">
			<div class="l-wrapper">
				<div class="q-calc">
					<ul class="q-calc__list" :class="selectedCategory != null ? 'active' : ''">
						<li class="q-calc__item">
							<span class="l-title">Вид отправки</span>
							<div class="q-calc__item-block" @click="toggleDropdown(1)">
								<span class="l-name">{{selectedCategory == null ? 'Выберите' : selectedCategory.name}}</span>
								<span class="l-icon__arrow"></span>
							</div>
							<div class="q-calc__item-content" :class="showDropdown == 1 ? 'active' : ''">
								<span class="" v-for="(item, index) in data" :key="item.id">
									<span @click="pickOtpravka(item)">{{item.name}}</span>	
								</span>
							</div>
						</li>
						<li class="q-calc__item">
							<span class="l-title">Пункт отправки</span>
							<div class="q-calc__item-block" @click='toggleDropdown(2)'>
								<span class="l-name">{{ selectedCity.name == undefined ? 'Город' : selectedCity.from }}</span>
								<span class="l-icon__arrow"></span>
							</div>
							<div class="q-calc__item-content" :class="showDropdown == 2 ? 'active' : ''">
								<span class="" @click="pickCity('other')">Другой город</span>
								<span v-for="(item, i) in selectedCategoryItems" :key="i">
									<span @click="pickCity(item)">
										{{ item?.name }}
									</span>
								</span>
							</div>
						</li>
						<li class="q-calc__item">
							<span class="l-title">Пункт прибытия</span>
							<div class="q-calc__item-block">
								<span class="l-name">{{ selectedCity.name == undefined? 'Город' : selectedCity.to }}</span>
							</div>
						</li>
						<li class="q-calc__item">
							<span class="l-title">Вес</span>
							<div class="q-calc__item-block" >
								<span class="q-calc__number-input">
									<input class="q-calc-number" id="ves" v-model="weigth" type="number" />
									<span>кг</span>
								</span>
							</div>
						</li>
						<li class="q-calc__item">
							<span class="l-title">Объем</span>
							<div class="q-calc__item-block">
								<span class="q-calc__number-input">
									<input class="q-calc-number" id="obem" v-model="volume" type="number" />
									<span>м3</span>
								</span>
							</div>
						</li>
					</ul>
					<div @click="calculate" class="l-calc__action q-calc__action " :class="selectedCategory != null ? 'active' : ''">
						<a class="btn btn-yellow" href="javascript:void(0)">Рассчитать</a>
					</div>
				</div>
				<pre>
					{{selectedCity}}
					{{weigth}}
					{{volume}}
				</pre>
			</div>
		</section>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>