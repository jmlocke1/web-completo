let pagina=1;const cita={nombre:"",fecha:"",hora:"",servicios:[]};function eventListeners(){cambiarSeccion(),paginaSiguiente(),paginaAnterior(),botonesPaginador(),mostrarResumen(),nombreCita(),fechaCita(),deshabilitarFechaAnterior(),horaCita()}function mostrarSeccion(){const e=document.querySelector(".mostrar-seccion");e&&e.classList.remove("mostrar-seccion");document.querySelector("#paso-"+pagina).classList.add("mostrar-seccion");const t=document.querySelector(".tabs .actual");t&&t.classList.remove("actual");document.querySelector(`[data-paso="${pagina}"]`).classList.add("actual")}function cambiarSeccion(){document.querySelectorAll(".tabs button").forEach(e=>{e.addEventListener("click",e=>{e.preventDefault(),pagina=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesPaginador()})})}function getUrl(){let e=window.location.origin;return e+=window.location.pathname,e}async function mostrarServicios(){try{const e=getUrl()+"servicios.php",t=await fetch(e);(await t.json()).forEach(e=>{const{id:t,nombre:n,precio:o}=e,a=document.createElement("P");a.textContent=n,a.classList.add("nombre-servicio");const c=document.createElement("P");c.textContent="$ "+o,c.classList.add("precio-servicio");const i=document.createElement("DIV");i.classList.add("servicio"),i.dataset.idServicio=t,i.onclick=seleccionarServicio,i.appendChild(a),i.appendChild(c),document.querySelector("#servicios").appendChild(i)})}catch(e){console.log(e)}}function seleccionarServicio(e){let t;if(t="P"===e.target.tagName?e.target.parentElement:e.target,t.classList.contains("seleccionado")){t.classList.remove("seleccionado");eliminarServicio(parseInt(t.dataset.idServicio))}else{t.classList.add("seleccionado");agregarServicio({id:parseInt(t.dataset.idServicio),nombre:t.firstElementChild.textContent,precio:t.firstElementChild.nextElementSibling.textContent})}}function eliminarServicio(e){const{servicios:t}=cita;cita.servicios=t.filter(t=>t.id!==e),console.log(cita)}function agregarServicio(e){const{servicios:t}=cita;cita.servicios=[...t,e],console.log(cita)}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",()=>{pagina++,botonesPaginador()})}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",()=>{pagina--,botonesPaginador()})}function botonesPaginador(){const e=document.querySelector("#siguiente"),t=document.querySelector("#anterior");1===pagina?t.classList.add("ocultar"):3===pagina?(e.classList.add("ocultar"),t.classList.remove("ocultar"),mostrarResumen()):(t.classList.remove("ocultar"),e.classList.remove("ocultar")),mostrarSeccion()}function mostrarResumen(){const{nombre:e,fecha:t,hora:n,servicios:o}=cita,a=document.querySelector(".contenido-resumen");for(;a.firstChild;)a.removeChild(a.firstChild);if(Object.values(cita).includes("")){const e=document.createElement("P");return e.textContent="Faltan datos de Servicios, hora, fecha o nombre",e.classList.add("invalidar-cita"),void a.appendChild(e)}const c=document.createElement("H3");c.textContent="Resumen de Cita";const i=document.createElement("P");i.innerHTML="<span>Nombre:</span> "+e;const r=document.createElement("P");r.innerHTML="<span>Fecha:</span> "+t;const s=document.createElement("P");s.innerHTML="<span>Hora:</span> "+n;const l=document.createElement("DIV");l.classList.add("resumen-servicios");const d=document.createElement("H3");d.textContent="Resumen de Servicios",l.appendChild(d);let m=0;o.forEach(e=>{const{nombre:t,precio:n}=e,o=document.createElement("DIV");o.classList.add("contenedor-servicio");const a=document.createElement("P");a.textContent=t;const c=document.createElement("P");c.textContent=n,c.classList.add("precio");const i=n.split("$");m+=parseInt(i[1].trim()),o.appendChild(a),o.appendChild(c),l.appendChild(o)}),a.appendChild(c),a.appendChild(i),a.appendChild(r),a.appendChild(s),a.appendChild(l);const u=document.createElement("P");u.classList.add("total"),u.innerHTML="<span>Total a Pagar:  </span> $ "+m,a.appendChild(u)}function nombreCita(){document.querySelector("#nombre").addEventListener("input",e=>{const t=e.target.value.trim();if(""===t||t.length<3)mostrarAlerta("Nombre no valido","error");else{const e=document.querySelector(".alerta");e&&e.remove(),cita.nombre=t}})}function mostrarAlerta(e,t){if(document.querySelector(".alerta"))return;const n=document.createElement("DIV");n.textContent=e,n.classList.add("alerta"),"error"===t&&n.classList.add("error");document.querySelector(".formulario").appendChild(n),setTimeout(()=>{n.remove()},3e3)}function fechaCita(){const e=document.querySelector("#fecha");e.addEventListener("input",t=>{const n=new Date(t.target.value).getUTCDay();[0,6].includes(n)?(t.preventDefault(),e.value="",mostrarAlerta("Fines de Semana no son permitidos","error")):(cita.fecha=e.value,console.log(cita))})}function deshabilitarFechaAnterior(){const e=document.querySelector("#fecha"),t=new Date,n=`${t.getFullYear()}-${t.getMonth()+1}-${t.getDate()+1}`;e.min=n}function horaCita(){const e=document.querySelector("#hora");e.addEventListener("input",t=>{const n=t.target.value,o=n.split(":");o[0]<10||o[0]>18?(mostrarAlerta("Hora no válida","error"),setTimeout(()=>{e.value=""},3e3)):(cita.hora=n,console.log(cita))})}document.addEventListener("DOMContentLoaded",(function(){mostrarServicios(),mostrarSeccion(),eventListeners()}));
//# sourceMappingURL=app.js.map