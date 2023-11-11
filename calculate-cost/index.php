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
								<input  @focus="clearInput"  class="q-calc-number" id="ves" v-model="weigth" type="number" />
								<span>кг</span>
							</span>
						</div>
					</li>
					<li class="q-calc__item">
						<span class="l-title">Объем</span>
						<div class="q-calc__item-block">
							<span class="q-calc__number-input">
								<input  @focus="clearInput"  class="q-calc-number" id="obem" v-model="volume" type="number" />
								<span>м3</span>
							</span>
						</div>
					</li>
				</ul>
				<div @click="calculate" class="l-calc__action q-calc__action " :class="selectedCategory != null ? 'active' : ''">
					<a class="btn btn-yellow" href="javascript:void(0)">Рассчитать</a>
				</div>
			</div>

			<div class="l-calc__summ-content" v-if="summ.active">
				<template v-if="summ.other">
					TEST
				</template>
				<template v-else>
					<div class="l-space-between">
						<div class=" l-space-between">
							<div class="l-summ__item">
								<svg width="32" height="33" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
									<g id="fluent:vehicle-truck-cube-20-filled">
									<path id="Vector" d="M3.26759 16.3223V23.2999C3.26759 24.8455 4.52199 26.0999 6.06759 26.0999H6.48039C6.664 27.0042 7.15457 27.8171 7.86898 28.401C8.58339 28.985 9.47771 29.304 10.4004 29.304C11.3231 29.304 12.2174 28.985 12.9318 28.401C13.6462 27.8171 14.1368 27.0042 14.3204 26.0999H16.0804C16.264 27.0042 16.7546 27.8171 17.469 28.401C18.1834 28.985 19.0777 29.304 20.0004 29.304C20.9231 29.304 21.8174 28.985 22.5318 28.401C23.2462 27.8171 23.7368 27.0042 23.9204 26.0999H26.4004C27.0369 26.0999 27.6474 25.8471 28.0974 25.397C28.5475 24.9469 28.8004 24.3365 28.8004 23.6999V17.6775C28.8004 17.3054 28.7138 16.9384 28.5476 16.6055L25.9588 11.4263C25.7594 11.0277 25.4529 10.6924 25.0736 10.4581C24.6944 10.2238 24.2574 10.0998 23.8116 10.0999H22.4004V8.09995C22.4004 7.35734 22.1054 6.64515 21.5803 6.12005C21.0552 5.59494 20.343 5.29995 19.6004 5.29995H16.2564C16.6052 5.81835 16.802 6.43915 16.802 7.08875V13.1111C16.8021 13.7054 16.6368 14.2879 16.3245 14.7934C16.0123 15.299 15.5654 15.7076 15.034 15.9735L10.234 18.3735C9.78962 18.5958 9.29962 18.7114 8.80279 18.7114C8.30596 18.7114 7.81596 18.5958 7.37159 18.3735L3.26759 16.3223ZM22.4004 11.6999H23.8116C23.9603 11.6997 24.1062 11.7408 24.2328 11.8188C24.3594 11.8968 24.4618 12.0086 24.5284 12.1415L26.7076 16.4999H22.4004V11.6999ZM10.4004 22.8999C11.0369 22.8999 11.6474 23.1528 12.0974 23.6029C12.5475 24.053 12.8004 24.6634 12.8004 25.2999C12.8004 25.9365 12.5475 26.5469 12.0974 26.997C11.6474 27.4471 11.0369 27.6999 10.4004 27.6999C9.76387 27.6999 9.15342 27.4471 8.70333 26.997C8.25325 26.5469 8.00039 25.9365 8.00039 25.2999C8.00039 24.6634 8.25325 24.053 8.70333 23.6029C9.15342 23.1528 9.76387 22.8999 10.4004 22.8999ZM17.6004 25.2999C17.6004 24.9848 17.6625 24.6727 17.7831 24.3815C17.9037 24.0903 18.0805 23.8258 18.3033 23.6029C18.5262 23.38 18.7908 23.2032 19.082 23.0826C19.3731 22.962 19.6852 22.8999 20.0004 22.8999C20.3156 22.8999 20.6276 22.962 20.9188 23.0826C21.21 23.2032 21.4746 23.38 21.6974 23.6029C21.9203 23.8258 22.0971 24.0903 22.2177 24.3815C22.3383 24.6727 22.4004 24.9848 22.4004 25.2999C22.4004 25.9365 22.1475 26.5469 21.6974 26.997C21.2474 27.4471 20.6369 27.6999 20.0004 27.6999C19.3639 27.6999 18.7534 27.4471 18.3033 26.997C17.8532 26.5469 17.6004 25.9365 17.6004 25.2999ZM2.40039 7.08875V13.1111C2.40025 13.4085 2.48297 13.7 2.63925 13.9529C2.79554 14.2058 3.01922 14.4102 3.28519 14.5431L8.08519 16.9431C8.30727 17.0541 8.55213 17.1119 8.80039 17.1119C9.04865 17.1119 9.29351 17.0541 9.51559 16.9431L14.3156 14.5431C14.5816 14.4102 14.8052 14.2058 14.9615 13.9529C15.1178 13.7 15.2005 13.4085 15.2004 13.1111V7.08875C15.2002 6.79169 15.1174 6.50054 14.9611 6.2479C14.8048 5.99527 14.5813 5.79113 14.3156 5.65835L9.51559 3.25835C9.29351 3.14737 9.04865 3.0896 8.80039 3.0896C8.55213 3.0896 8.30727 3.14737 8.08519 3.25835L3.28519 5.65835C3.01946 5.79113 2.79595 5.99527 2.63967 6.2479C2.4834 6.50054 2.40055 6.79169 2.40039 7.08875ZM5.11079 6.96395L8.80039 8.52075L12.49 6.96395C12.6825 6.89501 12.8942 6.90244 13.0814 6.9847C13.2687 7.06696 13.4173 7.21781 13.4968 7.40626C13.5762 7.5947 13.5805 7.80643 13.5087 7.99793C13.437 8.18944 13.2946 8.34618 13.1108 8.43595L9.60039 9.92075V14.0999C9.60039 14.3121 9.51611 14.5156 9.36608 14.6656C9.21605 14.8157 9.01256 14.8999 8.80039 14.8999C8.58822 14.8999 8.38473 14.8157 8.23471 14.6656C8.08468 14.5156 8.00039 14.3121 8.00039 14.0999V9.91915L4.48999 8.43755C4.38962 8.39932 4.29797 8.34128 4.22051 8.26688C4.14305 8.19247 4.08136 8.10324 4.03913 8.00448C3.9969 7.90573 3.97499 7.79948 3.9747 7.69208C3.97441 7.58467 3.99575 7.47831 4.03744 7.37933C4.07914 7.28035 4.14035 7.19078 4.2174 7.11596C4.29446 7.04114 4.38579 6.9826 4.48596 6.94384C4.58613 6.90508 4.69307 6.88688 4.80042 6.89033C4.90777 6.89379 5.01332 6.91882 5.11079 6.96395Z" fill="#3AC4A7"/>
									</g>
								</svg>
		
								<div class="flex-col">
									<span class="l-text l-14">{{selectedCategory?.name}}</span>
									<span class="l-text l-21">{{selectedCity?.name}}</span>
								</div>

							</div>
						</div>
						<span class="l-text l-28">{{summ?.price}} ₽</span>
					</div>

					<div class="l-space-between">
						<div class="l-summ__item">
							<svg xmlns="http://www.w3.org/2000/svg" width="32" height="33" viewBox="0 0 32 33" fill="none">
								<g clip-path="url(#clip0_319_4714)">
									<path d="M15.9993 3.16675C23.3633 3.16675 29.3327 9.13608 29.3327 16.5001C29.3327 23.8641 23.3633 29.8334 15.9993 29.8334C8.63535 29.8334 2.66602 23.8641 2.66602 16.5001C2.66602 9.13608 8.63535 3.16675 15.9993 3.16675ZM15.9993 8.50008C15.6457 8.50008 15.3066 8.64056 15.0565 8.89061C14.8065 9.14065 14.666 9.47979 14.666 9.83341V16.5001C14.6661 16.8537 14.8066 17.1928 15.0567 17.4427L19.0567 21.4427C19.3082 21.6856 19.645 21.82 19.9945 21.817C20.3441 21.8139 20.6786 21.6737 20.9258 21.4265C21.173 21.1793 21.3132 20.8449 21.3162 20.4953C21.3193 20.1457 21.1849 19.8089 20.942 19.5574L17.3327 15.9481V9.83341C17.3327 9.47979 17.1922 9.14065 16.9422 8.89061C16.6921 8.64056 16.353 8.50008 15.9993 8.50008Z" fill="#3AC4A7"/>
								</g>
								<defs>
									<clipPath id="clip0_319_4714">
										<rect width="32" height="32" fill="white" transform="translate(0 0.5)"/>
									</clipPath>
								</defs>
							</svg>
							<span class="l-text l-21">В пути</span>
						</div>
						<div>
							<span class="l-text l-28">{{summ?.time}}</span>
						</div>
					</div>
				</template>
			</div>
			
			<div class="l-calc__summ-oformleine" v-if="summ.active">
					<spa class="l-text">Перейти к отправки груза</spa>
					<div class="l-calc__action q-calc__action active">
						<a class="btn btn-yellow" href="#">Оформить заказ</a>
					</div>
				</div>
		</div>
	</section>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>