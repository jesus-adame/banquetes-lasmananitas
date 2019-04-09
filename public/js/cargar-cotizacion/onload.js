
addEventListener('DOMContentLoaded', () => {

   let dataCot = new FormData;
   let cot = location.search.split('&')[1].split('=')
   
   dataCot.append(cot[0], cot[1])
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
   dataTotales.append(cot[0], cot[1])
   dataTotales.append('action', 'obtener_totales')

   getTotales(dataTotales)
})
