(function() {
    //boton para mostar modal
    const nuevaTareaBtn = document.querySelector('#agregar-tarea');
    nuevaTareaBtn.addEventListener('click', mostrarFormulario);

    function mostrarFormulario() {
        const modal = document.createElement('DVI');
        modal.classList.add('modal');
        modal.innerHTML = `
            <form class="formulario nueva-tarea">
                <legend>Agrega una Nuvea Tarea</legend>
                <div class="campo">
                    <label for="tarea" class="tarea">Tarea</label>
                    <input type="text" name="tarea" placeholder="Agrega tarea al Proyecto Actual" id="tarea">
                </div>
                <div class="opciones">
                    <input type="submit" value="Agregar Tarea" class="submit-nueva-tarea">
                    <button type="button" class="cerrar-modal">Cancelar</button>
                </div> 
            </form>
        `;
        setTimeout(() => {
            const formulario = document.querySelector('.formulario');
            formulario.classList.add('animar');
        }, 100);

        modal.addEventListener('click', function(e) {
            e.preventDefault();
            if (e.target.classList.contains('cerrar-modal')) {
                const formulario = document.querySelector('.formulario');
                formulario.classList.add('cerrar');
                setTimeout(() => {
                    modal.remove();
                }, 200);
            }

            if (e.target.classList.contains('submit-nueva-tarea')) {
                submitFormularioNuevaTarea();
            }

        });


        document.querySelector('.dashboard').appendChild(modal);
    }

    function submitFormularioNuevaTarea() {
        const tarea = document.querySelector('#tarea').value.trim();
        if (tarea === '') {
            //mostrar alerta
            referencia = document.querySelector('.formulario legend');
            mostrarAlerta('El nombre de la tarea es obligatorio', 'error', referencia);
            return;
        }

        agregarTarea(tarea);
    }

    function mostrarAlerta(mensaje, tipo, referencia) {

        //prevenir multiples alerta
        const mostrarAlerta = document.querySelector('.alerta');
        if (mostrarAlerta) {
            mostrarAlerta.remove();
        }

        const alerta = document.createElement('DIV')
        alerta.classList.add('alerta', tipo);
        alerta.textContent = mensaje;

        referencia.parentElement.insertBefore(alerta, referencia.nextElementSibling);

        setTimeout(() => {
            alerta.remove();
        }, 3500);
    }

    //consultar el servidor para agregar una tarea
    async function agregarTarea(tarea) {
        //CONTRUIR LA PETICION
        const datos = new FormData();
        datos.append('nombre', tarea);
        datos.append('proyectoId', obtenerProyecto());

        try {
            const url = 'http://localhost:3000/api/tarea';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });

            const resultado = await respuesta.json();

            referencia = document.querySelector('.formulario legend');
            mostrarAlerta(resultado.mensaje, resultado.tipo, referencia);

            if (resultado.tipo === 'exito') {
                const modal = document.querySelector('.modal');
                setTimeout(() => {
                    modal.remove();
                }, 1000);
            }

        } catch (error) {
            console.log(error);
        }
    }

    function obtenerProyecto() {
        const proyectoParams = new URLSearchParams(window.location.search);
        const proyecto = Object.fromEntries(proyectoParams.entries());
        return proyecto.task;
    }
})();