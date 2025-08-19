# Mini Twitter Klon – Dokumentation

## Überblick

Dieses Projekt ist ein Mini-Twitter-Klon mit folgenden Kernfunktionen:
- Benutzer können Beiträge (Posts) erstellen, anzeigen und löschen.
- Beiträge können von anderen Benutzern geliked werden (Like/Unlike).
- Jeder Benutzer hat eine öffentliche Profilseite mit eigenen Beiträgen und Statistiken.
- Beiträge können nach "Neueste" oder "Trending" (meiste Likes) gefiltert werden.
- Die Anzeige aktualisiert sich automatisch (Polling).
- Pagination ab 5 Beiträgen pro Seite.

---

## 1. Migrationen

### Posts-Tabelle

- Erstellt mit:  
  `php artisan make:migration create_posts_table`
- Felder:
  - `id`: Primärschlüssel
  - `user_id`: Fremdschlüssel zum User (Besitzer des Posts)
  - `title`: Titel des Beitrags
  - `body`: Text des Beitrags
  - `timestamps`: Erstellt-/Aktualisiert-Zeitpunkt

### Likes-Tabelle

- Erstellt mit:  
  `php artisan make:migration create_likes_table`
- Felder:
  - `id`: Primärschlüssel
  - `user_id`: Fremdschlüssel zum User (wer geliked hat)
  - `post_id`: Fremdschlüssel zum Post (welcher Post geliked wurde)
  - `timestamps`: Erstellt-/Aktualisiert-Zeitpunkt
  - Einzigartige Kombination aus `user_id` und `post_id` (damit ein User einen Post nur einmal liken kann)

---

## 2. Models

### Post Model

- Erstellt mit:  
  `php artisan make:model Post`
- Beziehungen:
  - `user()`: Zugehöriger User (Besitzer)
  - `likes()`: Alle Likes zu diesem Post

### Like Model

- Erstellt mit:  
  `php artisan make:model Like`
- Beziehungen:
  - `user()`: User, der geliked hat
  - `post()`: Post, der geliked wurde

---

## 3. Livewire-Komponente: DiscoverContent

**Datei:** `app/Livewire/DiscoverContent.php`

### Zweck

Diese Komponente steuert das Erstellen, Anzeigen, Filtern und Liken von Beiträgen.

### Features

- **Beiträge erstellen:**  
  Über ein Modal mit Flux-Komponenten können neue Beiträge mit Titel und Body erstellt werden.

- **Beiträge anzeigen:**  
  Alle Beiträge werden als Cards angezeigt, inklusive Name und Initiale des Users, Titel, Body, Like-Anzahl und Like-Button (Herz).

- **Beiträge filtern:**  
  Über eine Flux-Radio-Komponente kann zwischen "Neueste" (latest) und "Trending" (meiste Likes) umgeschaltet werden.

- **Likes:**  
  Jeder Beitrag kann geliked und wieder entliked werden. Das Herz-Icon färbt sich rot, wenn geliked.

- **Pagination:**  
  Es werden immer 5 Beiträge pro Seite angezeigt, mit Blätterfunktion.

- **Automatische Aktualisierung:**  
  Mit `wire:poll.5s` werden neue Beiträge und Likes alle 5 Sekunden automatisch geladen.

### Wichtige Variablen

- `$title`: Titel des neuen Beitrags
- `$body`: Inhalt des neuen Beitrags
- `$filter`: Filter für die Sortierung ("latest" oder "most_liked")

### Wichtige Methoden

- **create()**  
  Validiert und erstellt einen neuen Beitrag mit Titel und Body.

- **like($postId)**  
  Liked oder entliked einen Beitrag (Toggle-Funktion).

- **render()**  
  Holt die Beiträge je nach Filter und gibt sie an die View zurück (inkl. Pagination).

---

## 4. Öffentliche Profilseite

**Datei:** `app/Livewire/UserProfile.php`  
**View:** `resources/views/livewire/user-profile.blade.php`

### Features

- **Profil-Initiale, Name und E-Mail** werden angezeigt.
- **Zähler für Beiträge:**  
  Zeigt die Gesamtanzahl der eigenen Beiträge.
- **Zähler für Likes:**  
  Zeigt die Gesamtanzahl der Likes, die alle eigenen Beiträge zusammen erhalten haben.
- **Eigene Beiträge:**  
  Listet alle eigenen Beiträge als Cards auf.
- **Beiträge löschen:**  
  Der User kann seine eigenen Beiträge direkt auf seiner Profilseite löschen.

---

## 5. Navigation & UX

- **Sidebar:**  
  Enthält einen Link zu "Mein Profil", der auf die öffentliche Profilseite des eingeloggten Users führt.
- **Profilbild/Initiale:**  
  Klick auf die Initiale eines Users in der Beitragsliste führt auf dessen öffentliche Profilseite.
- **Responsives, modernes Design** mit Flux- und Tailwind-Komponenten.

---

## 6. Sonstiges

- **Alle Komponenten und Features nutzen ausschließlich kostenlose Flux-Komponenten.**
- **Alle Datenbankabfragen sind für Performance optimiert (Eager Loading, Pagination).**
- **Die wichtigsten Aktionen (Erstellen, Liken, Löschen) funktionieren ohne Seitenreload dank Livewire.**

---