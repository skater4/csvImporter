<?php
// src/app/Views/products/index.php
?>
<div class="container py-4">

    <!-- Карточка с формой импорта -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Импорт товаров из CSV
        </div>
        <div class="card-body">
            <?php if (!empty($imported)): ?>
                <div class="alert alert-success">
                    Импортировано строк: <strong><?= (int)$imported ?></strong>
                </div>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($error, ENT_QUOTES) ?>
                </div>
            <?php endif; ?>

            <form action="/products/importCsv" method="post" enctype="multipart/form-data" class="row gx-2 gy-3 align-items-end">
                <div class="col-auto">
                    <label for="csvFile" class="form-label">Выберите CSV-файл</label>
                    <input type="file" id="csvFile" name="csv" class="form-control" accept=".csv" required>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-outline-primary">Импортировать</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Карточка со списком товаров -->
    <div class="card">
        <div class="card-header bg-secondary text-white">
            Список товаров (<?= count($items) ?>)
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm mb-0">
                    <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Код</th>
                        <th>Наименование</th>
                        <th>Уровень&nbsp;1</th>
                        <th>Уровень&nbsp;2</th>
                        <th>Уровень&nbsp;3</th>
                        <th>Цена</th>
                        <th>Цена&nbsp;СП</th>
                        <th>Кол-во</th>
                        <th>Поля свойств</th>
                        <th>Совместные покупки</th>
                        <th>Ед. измер.</th>
                        <th>Картинка</th>
                        <th>На&nbsp;главной</th>
                        <th>Описание</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td><?= $item->id ?></td>
                            <td><?= htmlspecialchars($item->code, ENT_QUOTES) ?></td>
                            <td class="text-wrap" style="max-width:200px;">
                                <?= htmlspecialchars($item->name, ENT_QUOTES) ?>
                            </td>
                            <td><?= htmlspecialchars($item->categoryLevel1 ?? '', ENT_QUOTES) ?></td>
                            <td><?= htmlspecialchars($item->categoryLevel2 ?? '', ENT_QUOTES) ?></td>
                            <td><?= htmlspecialchars($item->categoryLevel3 ?? '', ENT_QUOTES) ?></td>
                            <td><?= number_format($item->price, 2, ',', ' ') ?></td>
                            <td><?= number_format($item->priceSp, 2, ',', ' ') ?></td>
                            <td><?= (int)$item->quantity ?></td>
                            <td class="text-wrap" style="max-width:150px;">
                                <?= htmlspecialchars($item->propertyFields, ENT_QUOTES) ?>
                            </td>
                            <td class="text-wrap" style="max-width:150px;">
                                <?= htmlspecialchars($item->jointPurchases, ENT_QUOTES) ?>
                            </td>
                            <td><?= htmlspecialchars($item->unit, ENT_QUOTES) ?></td>
                            <td>
                                <?php if ($item->imagePath): ?>
                                    <img src="<?= htmlspecialchars($item->imagePath, ENT_QUOTES) ?>"
                                         alt="" class="img-fluid" style="max-height:50px;">
                                <?php endif; ?>
                            </td>
                            <td><?= $item->showOnMain ? '✓' : '' ?></td>
                            <td class="text-wrap" style="max-width:200px;">
                                <?= nl2br(htmlspecialchars($item->description ?? '', ENT_QUOTES)) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
