sellyear = 2019;

addEventListener('DOMContentLoaded', () => {
   cargarVentaSem1();
   cargarVentaSem2();
   sellYear.innerHTML = sellyear;

   window.addEventListener('click', e => {

      switch (e.target.classList[0]) {
         case 'nextyear':
         sellyear++;
         sellYear.innerHTML = sellyear;
         cargarVentaSem1();
         cargarVentaSem2();
         break;

         case 'prevyear':
         sellyear--;
         sellYear.innerHTML = sellyear;
         cargarVentaSem1();
         cargarVentaSem2();
         break;
      }

      console.log(sellyear)
   })
})