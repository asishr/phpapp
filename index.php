<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use PhpApp\GreetingService;

$name = isset($_GET['name']) ? (string) $_GET['name'] : '';
$greetingService = new GreetingService();
$message = $greetingService->greetingFor($name);
$time = (new DateTimeImmutable('now'))->format('Y-m-d H:i:s T');

?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PHP App + Azure Pipelines</title>
  <style>
    body {
      font-family: "Segoe UI", Tahoma, sans-serif;
      margin: 0;
      padding: 2rem;
      background: linear-gradient(135deg, #eef6ff 0%, #f8fbff 100%);
      color: #10243e;
    }
    .card {
      max-width: 720px;
      background: #ffffff;
      border: 1px solid #dce8f6;
      border-radius: 12px;
      box-shadow: 0 10px 24px rgba(0, 52, 110, 0.08);
      padding: 1.5rem;
      margin: 0 auto;
    }
    h1 {
      margin-top: 0;
      color: #004a9f;
    }
    form {
      display: flex;
      gap: 0.75rem;
      flex-wrap: wrap;
      margin: 1rem 0;
    }
    input {
      flex: 1;
      min-width: 220px;
      border: 1px solid #b9cee8;
      border-radius: 8px;
      padding: 0.65rem 0.75rem;
      font-size: 1rem;
    }
    button {
      border: 0;
      border-radius: 8px;
      padding: 0.65rem 1rem;
      font-size: 1rem;
      background: #005fb8;
      color: white;
      cursor: pointer;
    }
    .message {
      margin: 0.75rem 0;
      font-size: 1.2rem;
      font-weight: 600;
    }
    .meta {
      color: #4a617d;
      font-size: 0.9rem;
    }
    code {
      background: #ecf4ff;
      padding: 0.1rem 0.35rem;
      border-radius: 6px;
    }
  </style>
</head>
<body>
  <main class="card">
    <h1>Sample PHP App for Azure Pipelines</h1>
    <p>Use this app to learn CI/CD with Azure DevOps pipelines.</p>

    <form method="get" action="/">
      <input type="text" name="name" placeholder="Enter your name" value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>">
      <button type="submit">Greet</button>
    </form>

    <p class="message"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
    <p class="meta">Request processed at <?= htmlspecialchars($time, ENT_QUOTES, 'UTF-8') ?></p>
    <p class="meta">Try: <code>?name=Azure+Student</code></p>
  </main>
</body>
</html>
