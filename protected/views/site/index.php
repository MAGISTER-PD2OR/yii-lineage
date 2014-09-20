<?php
$this->pageTitle=Yii::app()->name;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit', array(
    'heading'=>'Lineage Kristall',
)); ?>
 
    <p>Добро пожаловать на бесплатный сервер Lineage II.</p>
    <p>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'success',
        'size'=>'large',
        'label'=>'Скачать L2.ini',
        'url'=>'/download/l2-inet.zip'
    )); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
            'type'=>'success',
            'size'=>'large',
            'label'=>'L2.ini для кристалла',
            'url'=>'/download/l2-local.zip'
    )); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
            'type'=>'success',
            'size'=>'large',
            'label'=>'Патч HF',
            'url'=>'https://dl.dropbox.com/u/31827471/lineage7.zip'
    )); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
            'type'=>'success',
            'size'=>'large',
            'label'=>'Патч Lindvior',
            'url'=>'https://dl.dropboxusercontent.com/u/31827471/system_lindvior.rar'
    )); ?>
    </p>
 
<?php $this->endWidget(); ?>

<div class="row">

<div class="span5"> 
<p class="text-info">На нашем сервере:</p>
<li>Полная реализация контекта Epilogue; Freya; High Five Part 1-5.</li>
<li>Осады всех элитных клан-холлов (абсолютно точное соотвествие оффу).</li>
<li>Полностью реализованные территориальные битвы (полностью без изъянов).</li>
<li>Вся цепочка эпик-квестов (Epilogue + High Five).</li>
<li>Все новые квесты (Freya, High Five).</li>
<li>Все новые скиллы (Freya, High Five).
</li><li>Item-Mall (100% соотвествие).</li>
<li>Олимпиада (High Five) - 100% реализация.</li>
<li>Kratei Cube.</li>
<li>Handy Blocker.</li>
<li>Аукцион вещей.</li>
<li>Подземный коллизей.</li>
<li>Все данные (нпс, петы, персонажы, вещи и т.д.) соответствуют официальному серверу.</li>
<li>Seed of Destruction, Seed of Infinity, Seed of Annihilation.</li>
<li>Эпиковые боссы: Beleth, Freya (Вся цепочка квестов, тяжелая стадия, нормальная стадия), Zaken (Все виды, дненвной, ночной и т.д.).</li>
<li>Hellbound полностью соответствует официальному серверу.</li>
<li>Все новые локации (Watcher of Tomb, Dragon Valley, Lair of Antharas).</li>
<li>Сквад-скиллы кланов.</li>
<li>Работают опции вещей (Olf's T-Shirt и т.д.).</li>
<li>Работает энергия агатиона.</li>
</div>
    
<div class="span4">

<p class="text-error">Сборка High Five Part 5 VIP от команды L2-scripts.ru</p>
<p>Мы перешли на новую сборку L2-Scripts High Five. За основу взяты исходники Overworld, L2-scripts Epilogue (VIP), Freya, полный функционал и обновления которых описаны в соотвествующих разделах сайта l2-scripts.ru. В сборку внедрена новая система защиты от брута и ддоса на логин и гейм порт.</p>
</div>
    
</div>