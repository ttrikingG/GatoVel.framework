<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    /*
    ================================================================
    | TÍTULO DINÂMICO DA PÁGINA
    ================================================================
    - A variável $title é passada pelo método contentView() da trait View.
    - Exemplo de chamada:
        $this->contentView('site.wellcome', [], 'site', 'Bem-vindo');
    - Se $title não for definido, será usado o valor padrão 'Gatovel1'.
    - htmlspecialchars() é usado para prevenir XSS.
    */
    ?>
    <title><?= isset($title) && $title ? htmlspecialchars($title) : 'Gatovel1' ?></title>

    <!-- Link para CSS principal -->
    <link rel="stylesheet" href="../assets/css/App.css">

</head>

<body>

    <?php
    /*
    ================================================================
    | CONTEÚDO PRINCIPAL DA PÁGINA
    ================================================================
    - O conteúdo específico da página (ex: site.wellcome.php) será
      carregado aqui.
    - Todas as variáveis passadas via $data no contentView() estarão
      disponíveis diretamente como variáveis.
    - Exemplo: $data['username'] => $username disponível na view.
    */
    ?>

    <?php
    /*
    ================================================================
    | SCRIPTS JAVASCRIPT
    ================================================================
    - Os scripts devem ser carregados no **footer**, para garantir:
        1. Todo o HTML (DOM) já foi carregado.
        2. O JS pode manipular elementos sem erros de carregamento.
    - Exemplo:
        <script src="../assets/js/app.js"></script>
    - Alternativa moderna:
        - Colocar no <head> com "defer":
            <script src="../assets/js/app.js" defer></script>
        - Evite "async" se o script depende do DOM.
    - É recomendado incluir scripts dentro da view footer e chamá-la
      via traits/View, mantendo a sequência correta de carregamento.
    */
    ?>

</body>
</html>
