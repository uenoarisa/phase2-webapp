// var type = 'pie';
  var type = 'doughnut';


  var data1 = {
    datasets: [{
      data: [30, 20, 10,5,5,20,20,10],
      backgroundColor: ['blue', '#4141f5', '#24c7e4d0','#6666f0d0','#74befad0','#6b99fdd0','#926bfdd0','#6040eed0','#3b2791d0']
    }]
  };

  var data2 = {
    // labels: ['N予備校', 'ドットインストール', '課題'],
    datasets: [{
      data: [40,20,40],
      backgroundColor:['blue', '#4141f5', '#24c7e4d0']
    }]
  };

  var options = {
    cutoutPercentage: 40,
    plugins: {
        tooltip: {
          enabled: false
       },
        datalabels: {
           font: {
               size: 13,
           },
           formatter: (value) => value.toString() + '%'
        }
      }
  };

  var ctx0 = document.getElementById('js-study-language_chart').getContext('2d');
  var myChart0 = new Chart(ctx0, {
    type: type,
    data: data1,
    options: options,
    plugins: [
      ChartDataLabels,
  ],
  });

  // ['HTML', 'CSS', 'JavaScript',"PHP","Laravel","SQL","SHELL",]

  var ctx1 = document.getElementById('js-study-contents_chart').getContext('2d');
  var myChart1 = new Chart(ctx1, {
    type: type,
    data: data2,
    options: options,
    plugins: [
      ChartDataLabels,
  ],
  });

  var ctx2 = document.getElementById('js-hours-bargraph').getContext('2d');

  let gradient = ctx2.createLinearGradient(0, 300, 0, 0);
  gradient.addColorStop(.1, 'blue');
  gradient.addColorStop(.3, 'skyblue');

  var data3 = {
    labels: [,2," ",4," ",6," ",8," ",10," ",12," ",14," ",16," ",18," ",20," ",22," ",24," ",26," ",28," ",30],
    datasets: [{
      data: [3,4,5,3,0,0,4,2,2,8,8,2,2,1,7,4,4,3,3,3,2,6,2,2,1,1,1,7,8],
      backgroundColor: gradient,
      barThickness: 8,
      borderRadius: 5
    }]
  };




  var myChart2 = new Chart(ctx2, {
    type: 'bar',
    data: data3,
    options:{
      plugins: {
        legend: false
      },
      scales:{
        // bar: {groupWidth: "30%"}, // バーの太さ
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 2,
            callback: function(tick) {
              return tick.toString()+"h";
            },
        },
        grid: {
          display: false
        }
        },
        x: {
          beginAtZero: true,
          ticks: {
            stepSize: 2
          },
          grid: {
            display:false
          }
        }
      
    }
}
  });





  // for(let i = 0;i<12;i++){
  //   COLOR = ['blue', '#4141f5', '#24c7e4d0','#6666f0d0','#74befad0','#6b99fdd0','#926bfdd0','#6040eed0','#3b2791d0','blue', '#4141f5', '#24c7e4d0']
  //   let span = document.getElementById(`span${i+1}`);
  //   span.style.backgroundColor=`${COLOR[i]}`;
  // }
  