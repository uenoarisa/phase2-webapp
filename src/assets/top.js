'use strict';
{
  const btn = document.getElementById('js-header-btn');
  let modal = document.getElementById('js-modal');
  let cover = document.getElementById('js-cover');
  let modalbtn2 = document.getElementById('js-modal-btn2');
  let complete = document.getElementById('js-complete');
  let loading = document.getElementById('js-loading')
  btn.addEventListener('click', () => {
    modal.classList.add('active');
    modal.classList.remove('close');
    cover.classList.add('active');
    cover.classList.remove('close');
  });

  const closebtn = document.getElementById('js-round_btn2');
  closebtn.addEventListener('click', () => {
    modal.classList.remove('active');
    cover.classList.remove('active');
  });


  modalbtn2.addEventListener('click', () => {
    loading.classList.add("active")
    let jstwitter = document.getElementById("js-twitter");
    if (jstwitter.checked){
      twitText();
    }
    setTimeout(() => {loading.classList.remove('active')}, 5000);
    complete.classList.add('active');
  });


  let roundbtn2 = document.getElementById('js-round_btn');
  roundbtn2.addEventListener('click', () => {
    complete.classList.remove('active');
    modal.classList.remove('active');
    cover.classList.remove('active');
  });




  // let calendarbtn = document.getElementById('js-calender');
  // calendarbtn.addEventListener('click',()=>{
  //   date = 
  // })

  // カレンダー＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿

  console.log(1)

  let modaldate =document.getElementById('js-modal-date');
  let wrapper = document.getElementById('js-wrapper')
  modaldate.addEventListener('click',() =>{
    wrapper.classList.add('active');
  })
  let calenderarrow= document.getElementById('js-calender__arrow');
  calenderarrow.addEventListener('click', ()=>{
    wrapper.classList.remove('active')
  })
  let calenderbtn= document.getElementById('js-calender');
  calenderbtn.addEventListener('click', () => {
    wrapper.classList.remove('active');
  });

  const week = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
  const today = new Date();
  // 月末だとずれる可能性があるため、1日固定で取得
  var showDate = new Date(today.getFullYear(), today.getMonth(), 1);

  // 初期表示
  window.onload = function () {
    showProcess(today);
  };
  // 前の月表示
  let prev = document.getElementById('prev');
  
  prev.addEventListener('click',()=>{
    showDate.setMonth(showDate.getMonth() - 1);
    showProcess(showDate);
  })

  // 次の月表示
  let next = document.getElementById('next');
  
  next.addEventListener('click',()=>{
    showDate.setMonth(showDate.getMonth() + 1);
    showProcess(showDate);
  })

  // カレンダー表示
  function showProcess(date) {
    var year = date.getFullYear();
    var month = date.getMonth();
    document.querySelector('#calender_header').innerHTML = year + "年 " + (month + 1) + "月";

    var calendar = createProcess(year, month);
    document.querySelector('#wrapper__calendar').innerHTML = calendar;
  }

  // カレンダー作成
  function createProcess(year, month) {
    // 曜日
    var calendar = "<table><tr class='dayOfWeek'>";
    for (var i = 0; i < week.length; i++) {
      calendar += "<th>" + week[i] + "</th>";
    }
    calendar += "</tr>";

    var count = 0;
    var startDayOfWeek = new Date(year, month, 1).getDay();
    var endDate = new Date(year, month + 1, 0).getDate();
    var lastMonthEndDate = new Date(year, month, 0).getDate();
    var row = Math.ceil((startDayOfWeek + endDate) / week.length);

    // 1行ずつ設定
    for (var i = 0; i < row; i++) {
      calendar += "<tr>";
      // 1colum単位で設定
      for (var j = 0; j < week.length; j++) {
        if (i == 0 && j < startDayOfWeek) {
          // 1行目で1日まで先月の日付を設定
          calendar += "<td class='disabled' >" + (lastMonthEndDate - startDayOfWeek + j + 1) + "</td>";
        } else if (count >= endDate) {
          // 最終行で最終日以降、翌月の日付を設定
          count++;
          calendar += "<td class='disabled'>" + (count - endDate) + "</td>";
        } else {
          // 当月の日付を曜日に照らし合わせて設定
          count++;
          if (year == today.getFullYear()
            && month == (today.getMonth())
            && count == today.getDate()) {
            calendar += `<td class="date today" data-date=${count} data-month=${month+1} onclick="getdate()">`+count +`</td>`
          } else {
            calendar += `<td class="date" data-date=${count} data-month=${month+1} onclick="getdate(${count},${month+1})">` + count + "</td>";
          }
        }
      }
      calendar += "</tr>";
    }
    return calendar;
  }




  function twitText() {
    var s, url;
    const ta3 = document.getElementById('modal__textarea3').value;
    s = ta3;
    url = document.location.href;
    
    if (s != "") {
      if (s.length > 140) {
        //文字数制限
        alert("テキストが140字を超えています");
      } else {
        //投稿画面を開く
        url = "http://twitter.com/share?url=" + escape(url) + "&text=" + s;
        window.open(url,"_blank","width=600,height=300");
      }
    }
  }


}