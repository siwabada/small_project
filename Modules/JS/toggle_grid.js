// @function toggleGrid()

function toggleGrid() {
  var _container = document.querySelector('.container');
  // 조건 검증
  // _container 요소에 .show-grid 클래스가 있어?
  // 있으면?
  if ( _container.classList.contains('show-grid') ) {
    _container.classList.remove('show-grid');
  }
  // 없으면?
  else {
    _container.classList.add('show-grid');
  }
}


//onkeydown 속성은 모든객체에서 사용이 가능
//사용자가 html 문서에서 키보드를 눌렀을때 함수가 호출
//만약 shiftKey를 누르고 && 71번 키코드를 누르면 toggleGrid 함수를 실행 = shift+g

document.onkeydown = function(event) {
  if ( event.shiftKey && event.keyCode === 71 ) {
    toggleGrid();
  }
}
