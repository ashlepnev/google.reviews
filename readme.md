Отзывы из Google Maps на вашем сайте
==============

Для работы компонента необходимо получить:

* **Google API key для Places API.** Получить API key можно в [Google Cloud](https://console.cloud.google.com/). Необходимо [создать проект](https://console.cloud.google.com/projectcreate) (или использовать существующий), привязать к нему Billing Account (тоже предварительно созданный). Далее, в проекте необходимо включить Places API (в состояние API Enabled) и затем в разделе Credentails создать ключ (кнопка Create Credentails -> API key), скопировать полученный ключ и вставить в соответствующий параметр компонента.
* **Place ID вашей компании.** Для получения Place ID перейдите по [ссылке на сервис Google](https://developers.google.com/maps/documentation/places/web-service/place-id). В подразделе Find the ID of a particular place, в поиске на карте введите название своей компании и выберите нужный адрес или филиал. Во всплывающем окошке вы найдете нужный Place ID.