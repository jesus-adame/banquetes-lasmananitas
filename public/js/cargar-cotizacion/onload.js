
addEventListener('DOMContentLoaded', () => {

   let dataCot = new FormData;
   let number = location.href;
   let cot = number.substr(number.length-1)
   
   dataCot.append('cot', cot);
   dataCot.append('action', 'obtener_cotizacion')

   /**-------------- CARGA LA TABLA DETALLE COTIZACIÓN -------------*/
   ajaxRequest('cargar_cotizacion', dataCot)
   .then(dataJson => {
      if (dataJson.error) {
         popup.alert({content: dataJson.msg})
      } else {
         let cot = dataJson.cotizacion,
         det = dataJson.detalle
         
         /** VARIFICA SI HAY COTIZACIONES */
         if (Object.keys(cot).length > 0) {
            pintarCotizacion(cot)
         }
         
         if (det.length > 0) {
            tbody_detalle_cot.innerHTML = pintarDetalle(det)
         }
      }
   })

   /**----------- CARGA LOS TOTALES DE LA TABLA DETALLE COTIZACIÓN -----*/
   let dataTotales = new FormData;
   dataTotales.append('cot', cot)
   dataTotales.append('action', 'obtener_totales')

   getTotales(dataTotales)
})
