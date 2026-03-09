<?php
require_once(__DIR__ . "/../model/Imovel.php");

$imoveis = Imovel::listarComfoto();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração de Imóveis</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #f5f6f8;
        }

        .navbar {
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }

        .content-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        }

        footer {
            background: #212529;
            color: white;
            padding: 40px 0;
            margin-top: 60px;
        }

        .section-title {
            font-weight: 600;
            margin-bottom: 0;
        }

        .table thead {
            background-color: #f8f9fa;
        }

        .badge-status {
            font-weight: 500;
            padding: 0.5em 0.8em;
        }

        .img-preview {
            width: 60px;
            height: 45px;
            object-fit: cover;
            border-radius: 4px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Painel Imobiliária</a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Imóveis</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Usuários</a></li>
                    <li class="nav-item"><a class="btn btn-outline-light ms-3" href="#">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="section-title">Gerenciamento de Imóveis</h4>

            <a href="painelCadImoveis.php" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Novo Imóvel
            </a>
        </div>

        <div class="content-card">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Título / Localização</th>
                            <th>Tipo</th>
                            <th>Preço</th>
                            <th>Status</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($imoveis as $imovel): ?>

                            <tr>

                                <td>
                                    <?php if (!empty($imovel->foto)): ?>
                                        <img src="../uploads/<?= $imovel->foto ?>" class="img-preview">
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <div class="fw-bold text-dark"><?= $imovel->titulo ?></div>

                                    <small class="text-muted">
                                        <?= $imovel->bairro ?> -
                                        <?= $imovel->cidade ?> -
                                        <?= $imovel->estado ?>
                                    </small>
                                </td>

                                <td><?= ucfirst($imovel->tipo) ?></td>

                                <td>R$ <?= number_format($imovel->preco, 2, ',', '.') ?></td>

                                <td>

                                    <?php
                                    $cor = [
                                        'Disponível' => 'success',
                                        'Vendido' => 'danger',
                                        'Alugado' => 'warning'
                                    ];

                                    $statusCor = $cor[$imovel->status] ?? 'secondary';
                                    ?>

                                    <span class="badge bg-<?= $statusCor ?> badge-status">
                                        <?= $imovel->status ?>
                                    </span>

                                </td>

                                <td class="text-end">

                                    <div class="btn-group">

                                        <a href="#" class="btn btn-sm btn-outline-primary" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <a href="../controller/Imovel.php?excluir_id=<?= $imovel->id ?>"
                                            class="btn btn-sm btn-outline-danger" title="Excluir">
                                            <i class="bi bi-trash"></i>
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <footer>
        <div class="container text-center">
            <p>Painel administrativo da imobiliária</p>
            <small>© 2026 Sistema interno</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>