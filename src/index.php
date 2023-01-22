<?php
require_once('dbconnect.php');
class Study {
  public $day;
  public $hours;

  public function get_day() {
      return $this->day;
  }

  public function get_hours() {
      return (int)$this->hours;
  }
}

try {
  $pdo = new PDO(
      "mysql:dbname=posse;host=db;charset=utf8mb4",
      'root',
      'root',
      [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      ]
  );
  $sql = 'SELECT date as `date`, sum(`hours`) as `sumhours` FROM studies where date LIKE "%-06-%" GROUP BY `date`';
  $formatted_study_data = $pdo->query($sql)->fetchAll();
  // $formatted_study_data = array_column($studies, 'date', 'sumhours');

  // $formatted_study_data = array_map(function($study) {
  //     return [$study->get_day(), $study->get_hours()];
  // }, $studies);
  $chart_data = json_encode($formatted_study_data);
  print_r($chart_data);
} catch (PDOException $e) {
  exit($e->getMessage()); 
}
// $sql = 'SELECT date as `grouping_column`, sum(`hours`) as `sumhours` FROM studies where date LIKE "%-06-%" GROUP BY `grouping_column`';

// $studies = $pdo->query($sql)->fetchAll(\PDO::FETCH_CLASS, Study::class);
// $formatted_study_data = array_map(function($study) {
//   return [$study->get_day(), $study->get_hours()];
// }, $studies);
// $chart_data = json_encode($formatted_study_data);


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>自主制作</title>
  <!-- <link rel="stylesheet" href="assets/css/normalize.css"> -->
  <link rel="stylesheet" href="../assets/css/webtop.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
</head>

<body>
  <div class="cover" id="js-cover"></div>
  <div class="complete" id="js-complete">
    <span class="round_btn" id="js-round_btn"></span>
    <h2>AWESOME!</h2>
    <div class="round_background">
      <span class="complete__check"></span>
    </div>
    <p>記録・投稿</p>
    <p>完了しました</p>
  </div>
  <div class="loadingbox" id="js-loading">
    <div class="loader">Loading...</div>
  </div>
  <script>
  function getdate(date, month) {
    console.log('2020年' + month + '月' + date + '日');
    document.getElementById("modal__textarea").value = '2020年' + month + '月' + date + '日';
  }
  </script>
  <div class="calender">

    <div class="wrapper" id="js-wrapper">
      <div class="calender_arrow" id="js-calender__arrow"><span class="dli-arrow-left"></span></div>
      <!-- xxxx年xx月を表示 -->
      <!-- ボタンクリックで月移動 -->
      <div id="next-prev-button">
        <button id="prev">‹</button>
        <h1 id="calender_header"></h1>
        <button id="next">›</button>
      </div>

      <!-- カレンダー -->
      <div id="wrapper__calendar"></div>

      <button class="calender__btn" id="js-calender">決定</button>
    </div>

  </div>
  <header class="header">
    <div class="header-logo">
      <img src="assets/logo.svg" alt="POSSEロゴ画像" class="header-logo__img">
      <p class="header-logo__p">4th week</p>
    </div>
    <button class="header-btn" id="js-header-btn">記録・投稿</button>
  </header>
  <section class="modal" id="js-modal">
    <span class="round_btn" id="js-round_btn2"></span>
    <div class="modal-contentinner">
      <div class="modal-inner_1">
        <div class="modal-date" id="js-modal-date">
          <h3 class="modal__h3">学習日</h3>
          <textarea name="" id="modal__textarea" cols="50" rows="1" class="modal__textarea"
            type="date">2020年10月27日</textarea>
        </div>
        <div class="modal-contents">
          <h3 class="modal__h3">学習コンテンツ(複数選択可)</h3>
          <div class="modal-contents__inner">
            <label class="ECM_CheckboxInput"><input class="ECM_CheckboxInput-Input" type="checkbox"><span
                class="ECM_CheckboxInput-DummyInput"></span><span class="ECM_CheckboxInput-LabelText">N予備校</span>
            </label>
            <label class="ECM_CheckboxInput"><input class="ECM_CheckboxInput-Input" type="checkbox"><span
                class="ECM_CheckboxInput-DummyInput"></span><span
                class="ECM_CheckboxInput-LabelText">ドットインストール</span></label>
            <label class="ECM_CheckboxInput"><input class="ECM_CheckboxInput-Input" type="checkbox"><span
                class="ECM_CheckboxInput-DummyInput"></span><span
                class="ECM_CheckboxInput-LabelText">POSSE課題</span></label>
          </div>
        </div>
        <div class="modal-language">
          <h3 class="modal__h3">学習言語(複数選択可)</h3>
          <div class="modal-language__inner">
            <label class="ECM_CheckboxInput" id="optioncheck"><input class="ECM_CheckboxInput-Input"
                type="checkbox"><span class="ECM_CheckboxInput-DummyInput"></span><span
                class="ECM_CheckboxInput-LabelText">HTML</span>
            </label>

            <label class="ECM_CheckboxInput"><input class="ECM_CheckboxInput-Input" type="checkbox"><span
                class="ECM_CheckboxInput-DummyInput"></span><span class="ECM_CheckboxInput-LabelText">CSS</span></label>

            <label class="ECM_CheckboxInput"><input class="ECM_CheckboxInput-Input" type="checkbox"><span
                class="ECM_CheckboxInput-DummyInput"></span><span
                class="ECM_CheckboxInput-LabelText">JavaScript</span></label>

            <label class="ECM_CheckboxInput"><input class="ECM_CheckboxInput-Input" type="checkbox"><span
                class="ECM_CheckboxInput-DummyInput"></span><span class="ECM_CheckboxInput-LabelText">PHP</span></label>

            <label class="ECM_CheckboxInput"><input class="ECM_CheckboxInput-Input" type="checkbox"><span
                class="ECM_CheckboxInput-DummyInput"></span><span
                class="ECM_CheckboxInput-LabelText">Larabel</span></label>

            <label class="ECM_CheckboxInput"><input class="ECM_CheckboxInput-Input" type="checkbox"><span
                class="ECM_CheckboxInput-DummyInput"></span><span
                class="ECM_CheckboxInput-LabelText">SHELL</span></label>

            <label class="ECM_CheckboxInput"><input class="ECM_CheckboxInput-Input" type="checkbox"><span
                class="ECM_CheckboxInput-DummyInput"></span><span class="ECM_CheckboxInput-LabelText">SQL</span></label>

            <label class="ECM_CheckboxInput"><input class="ECM_CheckboxInput-Input" type="checkbox"><span
                class="ECM_CheckboxInput-DummyInput"></span><span
                class="ECM_CheckboxInput-LabelText">情報システム基礎知識（その他）</span></label>
          </div>
        </div>
      </div>
      <div class="modal-inner_2">
        <div class="modal-contents">
          <h3 class="modal__h3">学習時間</h3>
          <textarea name="" id="modal__textarea2" cols="80" rows="1" class="modal__textarea"></textarea>
        </div>
        <div class="modal-language2">
          <h3 class="modal__h3">twitter用コメント</h3>
          <textarea name="" id="modal__textarea3" cols="80" rows="30" class="modal__textarea"></textarea>
          <br>
          <label class="ECM_CheckboxInput2"><input class="ECM_CheckboxInput-Input2" type="checkbox"
              id="js-twitter"><span class="ECM_CheckboxInput-DummyInput2"></span><span
              class="ECM_CheckboxInput-LabelText2">Twitterにシェアする</span></label>
        </div>
      </div>
    </div>

    <button class="modal-btn" id="js-modal-btn2">記録・投稿</button>
  </section>
  <main>
    <div class="main">
      <div class="study-hours">
        <section class="study-hoursーfigure">
          <ul class="study-hours-figure__ul">
            <li class="study-hours-figure__li">
              <h2 class="study-hours-figure__h2">Today</h2>
              <p class="study-hours-figure__p">
                <?php
                $stmt = $pdo->query('SELECT sum(hours) FROM studies WHERE date = "2022-06-18"')->fetch(PDO::FETCH_ASSOC);
                print_r($stmt['sum(hours)']);
                ?>
              </p>
              <h3 class="study-hours-figure__h3">hour</h3>
            </li>
            <li class="study-hours-figure__li">
              <h2 class="study-hours-figure__h2">Month</h2>
              <p class="study-hours-figure__p">
                <?php
                $stmt = $pdo->query('SELECT sum(hours) FROM studies WHERE date LIKE "%-06-%"')->fetch(PDO::FETCH_ASSOC);
                print_r($stmt['sum(hours)']);
                ?>
              </p>
              <h3 class="study-hours-figure__h3">hour</h3>
            </li>
            <li class="study-hours-figure__li">
              <h2 class="study-hours-figure__h2">Total</h2>
              <p class="study-hours-figure__p">
                <?php
                  $stmt = $pdo->query('SELECT sum(hours) FROM studies')->fetch(PDO::FETCH_ASSOC);
                  print_r($stmt['sum(hours)']);
                ?>
              </p>
              <h3 class="study-hours-figure__h3">hour</h3>
            </li>
          </ul>
        </section>
        <!-- 時間 -->
        <section class="study-hours-bargraph" id="js-study-hours_bargraph">
          <div class="hours-div">
            <canvas class="hours-bargraph" id="js-hours-bargraph"></canvas>
          </div>
        </section>
      </div>
      <div class="study-inner">
        <section class="study-language study-innerbox">
          <h2 class="study-inner__h2">学習言語</h2>
          <div>
            <canvas class="language_chart" id="js-study-language_chart">
            </canvas>
            <ul id="js-language_chart_ul" class="language_chart">
              <span class="span" id="span1"></span>
              <li>JavaScript</li>
              <span class="span" id="span2"></span>
              <li>CSS</li>
              <span class="span" id="span3"></span>
              <li>PHP　　
              </li>
              <span class="span" id="span4"></span>
              <li class="HTML">HTML</li>
              <span class="span" id="span5"></span>
              <li>Larabel</li>
              <span class="span" id="span6"></span>
              <li>SQL　　</li>
              <span class="span" id="span7"></span>
              <li>SHELL</li>

              <span class="span" id="span8"></span>
              <li>情報システム基礎知識（その他）</li>
            </ul>

          </div>
        </section>
        <section class="study-contents study-innerbox">
          <h2 class="study-inner__h2">学習コンテンツ</h2>
          <div>
            <canvas class="contents_chart" id="js-study-contents_chart">
            </canvas>
            <ul class="contents_chart" id="js-contents_chart_ul">
              <span class="span" id="span9"></span>
              <li>ドットインストール</li>
              <span class="span" id="span10"></span>
              <li>N予備校　　　　　</li>
              <span class="span" id="span11"></span>
              <li>POSSE課題</li>
            </ul>
          </div>
        </section>
      </div>
    </div>
    <div class="arrow__date">
      <span class="dli-chevron-round-left"></span>
      <p>2022年10月</p>
      <span class="dli-chevron-round-right"></span>
    </div>
  </main>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


  <script>

  </script>

  </body>
  </html>

  <!-- チャート用データをとってくる -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script>
  google.charts.load('current', {packages: ['corechart', 'bar']});

  google.charts.setOnLoadCallback(function () {
    let chart_data = <?php echo ($chart_data); ?>;
    let true_data = [];
    for (let i = 0; i < chart_data.length; i++){
      let day = chart_data[i]["date"];
      let hour = parseInt(chart_data[i]["sumhours"]);
      true_data.push(day);
      true_data.push(hour);
    }
    const chunk = (arrayData, chunkSize) => Array.from({length: Math.ceil(arrayData.length / chunkSize)}, (v, i) =>
    arrayData.slice(i * chunkSize, i * chunkSize + chunkSize));
    let bar_graph_array = chunk(true_data, 2);
    console.log(bar_graph_array);


    const data = new google.visualization.DataTable();
    data.addColumn('string', 'hoge date');
    data.addColumn('number', 'fuga hours');
    data.addRows( `${bar_graph_array} `);
    const chart = new google.visualization.ColumnChart(document.getElementById('js-hours-bargraph'));
    chart.draw(data, { title: '日毎の学習時間' });
  });
  </script>
  

