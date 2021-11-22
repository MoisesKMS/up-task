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
                    <div class="opciones">
                        <input type="submit" value="Agregar Tarea" class="submit-nueva-tarea">
                        <button type="button" class="cerrar-modal">Cancelar</button>
                    </div> 
                </div>
            </form>
        `;

        document.querySelector('body').appendChild(modal);
    }
})();