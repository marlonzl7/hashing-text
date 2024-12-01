<?php

function codificarTexto($texto, $algoritmo) {
    switch ($algoritmo) {
        case 'bcrypt':
            // Codifica o texto usando o BCRYPT
            return password_hash($texto, PASSWORD_BCRYPT);
            break;
        case 'md5':
            // Codifica o texto usando o MD5
            return md5($texto);
            break;
        case 'sha1':
            // Codifica o texto usando o SHA1
            return sha1($texto);
            break;
        default:
            throw new Exception("Algoritmo inválido");
            break;
    }
}

// Verifica se o formulário foi enviado
$algoritmo = $_POST['algoritmo'] ?? '';
$texto = $_POST['entrada'] ?? '';
$textoCodificado = '';

if (!empty($texto)) {
    $textoCodificado = codificarTexto($texto, $algoritmo);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/estilo/style.css">
    <link rel="shortcut icon" href="./assets/icons/encypted-icon.svg" type="image/svg+xml">
    <title>Criptografia</title>
</head>
<body>
    <main>
        <header>
            <h1>Criptografar Texto</h1>
        </header>
        <form action="" method="post">
            <div class="input-group">
                <div class="input-box">
                    <div class="input-box-label">
                        <label for="entrada">Entrada</label>
                    </div>
                    <textarea name="entrada" id="" cols="30" rows="10" required></textarea>
                </div>
                <div class="input-box">
                    <select name="algoritmo" id="algoritmo">
                        <option value="bcrypt" <?= ($algoritmo == 'bcrypt') ? 'selected' : ''; ?>>BCRYPT</option>
                        <option value="md5" <?= ($algoritmo == 'md5') ? 'selected' : ''; ?>>MD5</option>
                        <option value="sha1" <?= ($algoritmo == 'sha1') ? 'selected' : ''; ?>>SHA1</option>
                    </select>
                </div>
                <div class="btn">
                    <button type="submit">Codificar</button>
                </div>
                <?php if (!empty($textoCodificado)) : ?>
                    <div class="input-box">
                        <div class="input-box-label">
                            <label for="saida">Saída</label>
                        </div>
                        <textarea name="saida" id="saida" cols="30" rows="10" disabled><?php echo htmlspecialchars($textoCodificado); ?></textarea>
                        <div class="algoritmo-usado">
                            <p>Algoritmo usado: <?php echo $algoritmo; ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </form>
    </main>
</body>
</html>