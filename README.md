
1. Поднять контейнеры:
   ```bash
   docker compose up -d --build
   ```

2. Установить зависимости и подготовить `.env`:
   ```bash
   docker compose exec app composer install
   cp .env.example .env
   docker compose exec app php artisan key:generate
   ```

3. Накатить миграции и открыть проект:
   ```bash
   docker compose exec app php artisan migrate
   ```
   Сайт: `http://localhost:8000`  

Troubleshooting:
если не запускается - удостовериться что с правами на директорию все ок

Как реализованно:
Для сервиса провайдера есть интерфейс с методами отправки запроса в клиент провайдера на создание платежа
и на обработку колбека. Так же есть интерфейс для самих клиентов провайдеров, которые на данный момент реализуются
только моками, но в любой момент можно добавить настоящий клиент и резолвить их в контейнере в зависимости 
от APP_ENV например

Добавление новых провайдеров:
Добавить новое значение в enum PaymentProvider
Создать NewProviderService, реализующий PaymentGatewayInterface
Создать NewProviderClientInterface и его реализацию
Добавить NewProviderStatusMapper
Добавить NewProviderValidation, реализующий PaymentValidationStrategy
Зарегистрировать клиент и стратегию в AppServiceProvider.
Добавить новый match-кейс в PaymentGatewayFactory.

