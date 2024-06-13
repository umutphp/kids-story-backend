# Masalcı

## Kurulum

1. Repoyu bilgisayarınıza indirin.

```bash
git clone git@github.com:umutphp/kids-story-backend.git
```

2. `composer` ile ilk kurumu yapın.

```bash
composer install
```

3. `.env` dosyasını oluşturun ve kullanacağınız ayarları yapın. `.env.example` dosyasında ön tanımlı olarak `Sqlite` veritabanı ve `Ollama` AI model runtime ayarlanmıştır.

```bash
cp .env.example .env
```

4. [Laravel Sail](https://laravel.com/docs/11.x/sail) ile uygulamayı çalıştırın.

```bash
./vendor/bin/sail up
```

5. Tarayıcınızdan http://localhost adresine girerek kullanıcı kaydını oluşturup http://localhost/admin adresinden CRUD arayüzüne ulaşabilirsiniz.

## Ollama

Docker Hub'daki resmi `ollama/ollama:latest` image'ı kullanarak `docker-compose.yml` dosyasına bir servis ekledim. Ama eğer direk makinanızda kurulu olan Ollama'yı kullanmak isterseniz de `.env` dosyasında OLLAMA_HOST değerini `host.docker.internal:11434` yapabilirsiniz.

Ayrıca Docker içinde çalışan Ollama için cache klasörünü ana makinadaki Ollama cache klasörü ile aynı yaparak aynı modelleri tekrar tekrar indirmeden kullanabilirsiniz.