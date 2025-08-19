# Mini Twitter Klon – Dokumentation

## Bisherige Schritte

### 1. Migrationen

#### Posts-Tabelle

- Erstellt mit:  
  `php artisan make:migration create_posts_table`
- Felder:
  - `id`: Primärschlüssel
  - `user_id`: Fremdschlüssel zum User (Besitzer des Posts)
  - `body`: Text des Beitrags
  - `timestamps`: Erstellt-/Aktualisiert-Zeitpunkt

#### Likes-Tabelle

- Erstellt mit:  
  `php artisan make:migration create_likes_table`
- Felder:
  - `id`: Primärschlüssel
  - `user_id`: Fremdschlüssel zum User (wer geliked hat)
  - `post_id`: Fremdschlüssel zum Post (welcher Post geliked wurde)
  - `timestamps`: Erstellt-/Aktualisiert-Zeitpunkt
  - Einzigartige Kombination aus `user_id` und `post_id` (damit ein User einen Post nur einmal liken kann)

### 2. Models

#### Post Model

- Erstellt mit:  
  `php artisan make:model Post`
- Beziehungen:
  - `user()`: Zugehöriger User (Besitzer)
  - `likes()`: Alle Likes zu diesem Post

#### Like Model

- Erstellt mit:  
  `php artisan make:model Like`
- Beziehungen:
  - `user()`: User, der geliked hat
  - `post()`: Post, der geliked wurde

---

## 3. Livewire-Komponente: DiscoverContent

**Datei:** `app/Livewire/DiscoverContent.php`

### Zweck

Diese Komponente steuert das Erstellen und Anzeigen von Posts (Tweets) sowie das Liken von Beiträgen.

### Variablen

- `$title`: (optional, aktuell nicht genutzt beim Speichern)
- `$body`: Inhalt des neuen Posts
- `$posts`: Liste aller Posts inkl. zugehöriger User und Likes

### Methoden

- **mount()**  
  Lädt alle Posts mit zugehörigen Usern und Likes, sortiert nach dem neuesten zuerst.

- **create()**  
  Validiert die Eingaben (`title` und `body`).  
  Erstellt einen neuen Post mit dem aktuellen User als Besitzer und dem eingegebenen Text.  
  Setzt die Eingabefelder zurück und lädt die Posts neu.

- **like($postId)**  
  Findet den Post anhand der ID.  
  Prüft, ob der aktuelle User diesen Post schon geliked hat.  
  Falls nicht, wird ein neuer Like-Eintrag erstellt.  
  Lädt die Posts neu, um die Like-Anzahl zu aktualisieren.

- **render()**  
  Gibt die zugehörige Blade-View (`livewire.discover-content`) zurück.

---

Damit ist die zentrale Logik für das Erstellen und Liken von