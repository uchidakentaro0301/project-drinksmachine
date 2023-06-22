//変数の定義
var storedWord;
var storedCompany;
var storedUpperPriceLimit;
var storedLowerPriceLimit;
var storedUpperStockLimit; 
var storedLowerStockLimit; 
var img;
var pressedButton;
var sortToggle;
var selectedId;
var imageURL;

$(function () {
  $.ajax({
    url: 'ajaxget', //通信先のアドレス（web.phpに記入してある物）
    method: 'GET', ///サーバーからデータを取得する
  })
 //Ajaxリクエストが成功した場合に実行されるコールバック関数を指定
  .done(function (data){ 
    $('#productList').empty(); //#productListを空にするために”.empty”を使用している
    $.each(data, function(key, value){  //$.each()メソッドを使用して繰り返し処理を行っている ここからエラー！？
      console.log(value);
      // if(value.product_image  === null){  //Nullであれば”img変数”に”No Data”の値を代入する
      //   img = "No Data";
      // }else{
      //   imageURL = value.product_image; //value.product_imageの値を”imageURL”変数に代入
      //   imageURL = imageURL.replace("public", "storage"); //imageURLの文字列”public”を"storage"に置き換えをしている。
      //   img = "<img class='product_image' src='"+imageURL+"' alt='' width='100px' height='100px'>";
      // }
      $('#productList').append(
        "<tr><td>"+value.id+"</td><td>"+img+"</td><td>"+value.product_name+"</td><td>"+value.price+"</td><td>"+value.stock+"</td><td>"+value.company_name+"</td> <td><a class='btn btn-outline-dark' href='/product/"+value.id+"'>詳細</a></td><td><button data-id=" + value.id +" class='btn btn-outline-danger deleteBtn'>削除</button></td></tr>"
      );
    });
  })
    .fail(function (){
      console.log('fail');
      console.log('data');
    });


//検索
//on('click'はイベントハンドラー　押された時に実行される
  $('#ajaxbnt').on('click', function (){  
    console.log('ggsd')
    $.ajax({
      headers:{
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
      },
      url:'ajaxSearch',
      method:'POST',
      dataType:'text',
      data:{
        "test":'cof',
        "word":$('#keyword').val(), //val=要素の値を取得する
        "company":$('#company_id').val(),//val=要素の値を取得する
        "upperPriceLimit":$('#upperPriceLimit').val(),//val=要素の値を取得する
        "lowerPriceLimit":$('#lowerPriceLimit').val(),//val=要素の値を取得する
        "upperStockLimit":$('#upperStockLimit').val(),//val=要素の値を取得する
        "lowerStockLimit":$('#lowerStockLimit').val()//val=要素の値を取得する
      }
    })
    .done(function (data){
      $('#productList').empty();
      $.each(data, function(key, val) {
        html = `
            <tr class="item" data_product_keyword:"${val.product_name}" data_company_keyword:"${val.company_name}">
            <td>${val.id}</td>
            <td><img src="/storage/img_path/" . ${val.img_path}></td>
            <td class="product_name">${val.product_name}</td>
            <td>${val.price}</td>
            <td>${val.stock}</td>
            <td>${val.company_name}</td>
            <td><button id="detail" onclick="clickDetail()">詳細表示</button></td>
            <td><form method="POST" action="delete/{id}">@csrf<input type="submit" id="delete" value="削除"></form></td>
            </tr>`
        $("#showAllProduct").append(html);
    });

      //テスト
      console.log(data);

    //   $.each(data, function(key, value){
    //     if(value.product_image  === null){
    //       img = "No Data";
    //     }else{
    //       imageURL = value.product_image;
    //       imageURL = imageURL.replace("public","storage");
    //       img = "<img class='product_image' src='"+imageURL+"' alt='' width='100px' height='100px'>";
    //     }
    //     $('#productList').append(
    //         "<tr><td>"+value.id+"</td><td>"+img+"</td><td>"+value.product_name+"</td><td>"+value.price+"</td><td>"+value.stock+"</td><td>"+value.company_name+"</td> <td><a class='btn btn-outline-dark' href='/product/"+value.id+"'>詳細</a></td><td><button data-id=" + value.id +" class='btn btn-outline-danger deleteBtn'>削除</button></td></tr>"
    //     );
    //   });
    //   $('#storePressButton').val(pressButton);
    //   $('#storedSprtToggle').val(sortToggle);
    // });
    // storedWord = $('#word').val();
    // storedCompany = $('#company').val();
    // storedUpperPriceLimit = $('#upperPriceLimit').val();
    // storedLowerPriceLimit = $('#lowerPriceLimit').val();
    // storedUpperStockLimit = $('#upperStockLimit').val();
    // storedLowerStockLimit = $('#lowerStockLimit').val();
    // $('#storedWord').val(storedWord);
    // $('#storedCompany').val(storedCompany);
    // $('#storedUpperPriceLimit').val(storedUpperPriceLimit);
    // $('#storedLowerPriceLimit').val(storedLowerPriceLimit);
    // $('#storedUpperStockLimit').val(storedUpperStockLimit);
    // $('#storedLowerStockLimit').val(storedLowerStockLimit);
    // $('.text-danger').empty();
    // $('.text-danger').empty();
  })
  .fail(function(){
    console.log('fail');
  });
});

//削除
// $(document).on('click', 'delite',function(){
//   sortToggle = $('#storeSortToggle').val();
//   if(sortToggle === 'asc'){
//     sortToggle = 'desc';
//   }else{
//     sortToggle = 'asc';
//   }
//   if(confirm('削除してよろしいですか？')){
//     $.ajax({
//       headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
//         'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
//       },  //↑name属性がcsrf-tokenのmetaタグのcontent属性の値を取得
//       url: 'ajaxDelete', //通信先アドレスで、このURLをあとでルートで設定します
//       method: 'POST', //HTTPメソッドの種別を指定します。1.9.0以前の場合はtype:を使用。
//       dataType:'json',
//       data:{
//         "id":$(this).data('id'),
//         "word":$('#storedWord').val(),
//         "company":$('#storedCompany').val(),
//         "upperPriceLimit":$('#storedUpperPriceLimit').val(),
//         "lowerPriceLimit":$('#storedLowerPriceLimit').val(),
//         "upperStockLimit":$('#storedUpperStockLimit').val(),
//         "lowerStockLimit":$('#storedLowerStockLimit').val(),
//         "pressedButton":$('#storedPressedButton').val(),
//         "sortToggle":sortToggle
//       }
//     })
//     .done(function (data){
//       $('#productList').empty();
//       $.each(data, function(key, value){
//         if(value.product_image  === null){
//           img = "No Data";
//         }else{
//           imageURL = value.product_image;
//           imageURL = imageURL.replace("public","storage");
//           img = "<img class='product_image' src='"+imageURL+"' alt='' width='100px' height='100px'>";
//         }
//         $('#productList').append(
//             "<tr><td>"+value.id+"</td><td>"+img+"</td><td>"+value.product_name+"</td><td>"+value.price+"</td><td>"+value.stock+"</td><td>"+value.company_name+"</td> <td><a class='btn btn-outline-dark' href='/product/"+value.id+"'>詳細</a></td><td><button data-id=" + value.id +" class='btn btn-outline-danger deleteBtn'>削除</button></td></tr>"
//         );
//       });
//       $('.text-danger').empty();
//     })
//     .fail(function () {
//       console.log('fail');
//       console.log(data);
//     });
//   }
});