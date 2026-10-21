<?php
/*
 * Configurações gerais do RASTRO + MARÉ.
 *
 * IMPORTANTE:
 * A criação do banco e das tabelas SQL está dentro do index.php,
 * conforme a orientação do professor.
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'rastro_mare');
define('DB_USER', 'root');
define('DB_PASS', '');

/* Credenciais da área administrativa do Livro de Visitas. */
define('ADMIN_USER', 'admin');
define('ADMIN_PASS', 'admin123');

/* Arquivo TXT usado exclusivamente pelo Livro de Visitas. */
define('VISITAS_DIR', __DIR__ . '/data');
define('VISITAS_FILE', VISITAS_DIR . '/visitas.txt');

function dbServidor(): PDO {
    static $pdo = null;

    if ($pdo === null) {
        $pdo = new PDO(
            'mysql:host=' . DB_HOST . ';charset=utf8mb4',
            DB_USER,
            DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    }

    return $pdo;
}

function db(): PDO {
    static $pdo = null;

    if ($pdo === null) {
        $pdo = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
            DB_USER,
            DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    }

    return $pdo;
}

function e($value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

/*
 * Le todas as entradas do Livro de Visitas.
 * Cada linha do visitas.txt é um registro JSON.
 */
function lerVisitas(): array {
    if (!is_dir(VISITAS_DIR)) {
        @mkdir(VISITAS_DIR, 0777, true);
    }

    if (!file_exists(VISITAS_FILE)) {
        @file_put_contents(VISITAS_FILE, '');
    }

    $linhas = @file(VISITAS_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if (!$linhas) {
        return [];
    }

    $visitas = [];

    foreach ($linhas as $linha) {
        $registro = json_decode($linha, true);

        if (is_array($registro) && isset($registro['id'])) {
            $visitas[] = $registro;
        }
    }

    return $visitas;
}

/* Salva todas as entradas novamente no TXT, mantendo uma entrada por linha. */
function salvarVisitas(array $visitas): bool {
    if (!is_dir(VISITAS_DIR)) {
        if (!@mkdir(VISITAS_DIR, 0777, true) && !is_dir(VISITAS_DIR)) {
            return false;
        }
    }

    $conteudo = '';

    foreach ($visitas as $visita) {
        $conteudo .= json_encode(
            $visita,
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        ) . PHP_EOL;
    }

    return @file_put_contents(VISITAS_FILE, $conteudo, LOCK_EX) !== false;
}

/* Gera o próximo ID do Livro de Visitas. */
function proximoIdVisita(array $visitas): int {
    $maior = 0;

    foreach ($visitas as $visita) {
        $maior = max($maior, (int)($visita['id'] ?? 0));
    }

    return $maior + 1;
}
