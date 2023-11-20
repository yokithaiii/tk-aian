<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");
?>
	<section  class="l-tablet">
		<div class="l-stages__mobile">
			<div class="flex">
				<span id="tabCounter">1/3</span>
				<span>Информация об отправителе</span>
			</div>
			<svg width="105" height="21" viewBox="0 0 105 21" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle cx="10" cy="10.5" r="10" fill="#3AC4A7"/>
				<rect x="20" y="9.5" width="65" height="2" fill="#A6D6CC"/>
				<circle cx="95" cy="10.5" r="10" fill="#A6D6CC"/>
				</svg>
				
		</div>
		<div class="stages">
			<div class="stages__num active">
				<span class="l-stages__border">1</span>
				<p class="l-stages__info">Информация об отправителе</p>
			</div>
			<div class="stages__num">
				<span class="l-stages__border">2</span>
				<p class="l-stages__info-2">Информация о получателе</p>
			</div>
			<div class="stages__num">
				<span class="l-stages__border" id="last">3</span>
				<p class="l-stages__info-2">Информация о грузе</p>
			</div>
		</div>
	
		<div class="l-tabs">
			<form id="order-form">
				<div class="l-tab active" data-tab="first">
					<div class="l-form__forms">
						<div class="l-form__place-1">
							<div class="l-form__name">
								<label class="l-form__text">Наименование организации</label>
								<input
									class="input-first-tab"
									id="formalize-name"
									type="text"
									placeholder="Внести данные"
									required
								/>
								<span class="error-first-tab" id="nameError" style="color: red;"></span>
							</div>
							<div class="l-form__contact">
								<label class="l-form__text">Контактное лицо (ФИО)</label>
								<input
								class="input-first-tab"
									id="formalize-contact"
									type="text"
									placeholder="Внести данные"
									required
								/>
								<span  class="error-first-tab" id="contactError" style="color: red;"></span>
							</div>
							<div class="l-form__number">
								<label class="l-form__text">Телефон</label>
								<input
								class="input-first-tab"
									id="formalize-phone"
									type="text"
									placeholder="Внести данные"
									required
								/>
								<span  class="error-first-tab" id="phoneError" style="color: red;"></span>
							</div>
						</div>
						<div class="l-form__place-2">
							<div class="l-form__city">
								<label class="l-form__text">Населенный пункт отгрузки</label>
								<input
								class="input-first-tab"
									id="formalize-city"
									type="text"
									placeholder="Внести данные"
									required
								/>
								<span  class="error-first-tab" id="cityError" style="color: red;"></span>
							</div>
							<div class="l-form__address">
								<label class="l-form__text">Адрес</label>
								<input
								class="input-first-tab"
									id="formalize-address"
									type="text"
									placeholder="Внести данные"
									required
								/>
								<span class="error-first-tab" id="addressError" style="color: red;"></span>
							</div>
						</div>
						<div class="l-form__place-3">
							<div class="l-form__comment">
								<label class="l-form__text">Примечание</label>
								<textarea id="formalize-comment-1" placeholder="Внести данные" name="l-comment"/></textarea>
							</div>
						</div>
					</div>
				<button onclick="validateForm()" class="l-form__button-frw" type="button">Далее</button>
			</div>
			<div class="l-tab" data-tab="second">
					<div class="l-form__forms">
						<div class="l-form__place-1">
							<div class="l-form__name">
								<label class="l-form__text">Наименование организации</label>
								<input
									class="input-second-tab"
									id="formalize-name2"
									type="text"
									placeholder="Внести данные"
								/>
								<span class="error-second-tab" id="nameError2" style="color: red;"></span>
							</div>
							<div class="l-form__contact">
								<label class="l-form__text">Контактное лицо (ФИО)</label>
								<input
								class="input-second-tab"
									id="formalize-contact2"
									type="text"
									placeholder="Внести данные"
								/>
								<span class="error-second-tab" id="contactError2" style="color: red;"></span>
							</div>
							<div class="l-form__number">
								<label class="l-form__text">Телефон</label>
								<input
								class="input-second-tab"
									id="formalize-phone2"
									type="text"
									placeholder="Внести данные"
								/>
								<span class="error-second-tab" id="phoneError2" style="color: red;"></span>
							</div>
						</div>
						<div class="l-form__place-2">
							<div class="l-form__city">
								<label class="l-form__text">Населенный пункт отгрузки</label>
								<input
								class="input-second-tab"
									id="formalize-city2"
									type="text"
									placeholder="Внести данные"
								/>
								<span class="error-second-tab" id="cityError2" style="color: red;"></span>
							</div>
							<div class="l-form__address">
								<label class="l-form__text">Адрес</label>
								<input
								class="input-second-tab"
									id="formalize-address2"
									type="text"
									placeholder="Внести данные"
								/>
								<span class="error-second-tab" id="addressError2" style="color: red;"></span>
							</div>
						</div>
						<div class="l-form__place-3">
							<div class="l-form__comment">
								<label class="l-form__text">Примечание</label>
								<textarea id="formalize-comment-2" placeholder="Внести данные" name="l-comment"/></textarea>
							</div>
						</div>
					</div>
					<div class="l-buttons">
						<button class="l-form__button-back" type="button">Назад</button>
						<button onclick="validateForm()" class="l-form__button-frw" type="button">Далее</button>
					</div>
			</div>
			<div class="l-tab" data-tab="third">
					<div class="l-form__forms">
						<div class="l-form__place-1 third">
							<div class="l-form__cargoName">
								<label class="l-form__text">Наименование груза</label>
								<input
								class="input-third-tab"
									id="formalize-cargoName"
									type="text"
									placeholder="Внести данные"
									required
								/>
								<span class="error-third-tab" id="cargoNameError" style="color: red;"></span>
							</div>
							<div class="l-form__numberOfSeats">
								<label class="l-form__text">Количество мест</label>
								<input
								class="input-third-tab"
									id="formalize-numberOfSeats"
									type="text"
									placeholder="Внести данные"
									required
								/>
								<span class="error-third-tab" id="numberOfSeatsError" style="color: red;"></span>
							</div>
						</div>
						<div class="l-form__place-2 third">
							<div class="l-form__weight">
								<label class="l-form__text">Общий вес</label>
								<input
								class="input-third-tab"
									id="formalize-weight"
									type="text"
									placeholder="Внести данные"
									required
								/>
								<span class="error-third-tab" id="weightError" style="color: red;"></span>
							</div>
							<div class="l-form__volume">
								<label class="l-form__text">Общий объем</label>
								<input
								class="input-third-tab"
									id="formalize-volume"
									type="text"
									placeholder="Внести данные"
									required
								/>
								<span class="error-third-tab" id="volumeError" style="color: red;"></span>
							</div>
							<div class="l-form__dimension">
								<label class="l-form__text">Габариты. см</label>
								<input
								class="input-third-tab"
									id="formalize-dimension"
									type="text"
									placeholder="Внести данные"
									required
								/>
								<span class="error-third-tab" id="dimensionError" style="color: red;"></span>
							</div>
						</div>
						<div class="l-form__place-3 third">
							<div class="l-form__value">
								<label class="l-form__text">Ценность</label>
								<input
								class="input-third-tab"
									id="formalize-value"
									type="text"
									placeholder="Внести данные"
									required
								/>
								<span class="error-third-tab" id="valueError" style="color: red;"></span>
							</div>
							<div class="l-form__shipmentDate">
								<label class="l-form__text">Дата готовности к отгрузке</label>
								<input
								class="input-third-tab"
									id="formalize-shipmentDate"
									type="text"
									placeholder="Внести данные"
									required
								/>
								<span class="error-third-tab" id="shipmentDateError" style="color: red;"></span>
							</div>
						</div>
						<div class="l-form__place-3">
							<div class="l-form__comment">
								<label class="l-form__text">Примечание</label>
								<textarea id="formalize-comment-3" placeholder="Внести данные" name="l-comment"/></textarea>
							</div>
						</div>
					</div>
					<div class="l-check">
						<span>После того как вы отправите заявку наша команда свяжется с вами, чтобы обсудить все детали и предложить оптимальное решение для вашей перевозки.</span>
						<div class="l-policy">
							<input class="input-third-tab" type="checkbox" id="privacyCheckbox">
							<label for="privacyCheckbox">Я ознакомлен(-а) с <span>Политикой конфиденциальности</span></label>
						</div>
						<div class="l-buttons">
							<button class="l-form__button-back" type="button">Назад</button>
							<button onclick="validateForm()" class="l-form__button-design" type="submit" form="form">Оформить заявку</button>
						</div>
					</div>
			</form>
			</div>
		</div>
	</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>