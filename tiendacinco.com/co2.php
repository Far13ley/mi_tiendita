<link rel="stylesheet" href="css/estylepro.css">
<body>
    <div class="comentarios">
        <h2>Comentarios</h2>
        
        <div class="formulario-comentarios">
            <textarea id="comentario" placeholder="Escribe tu comentario..." rows="4"></textarea>
            <button onclick="agregarComentario()">Enviar Comentario</button>
        </div>

        <div class="comentarios-lista" id="listaComentarios">
            <!-- Los comentarios aparecerán aquí -->
        </div>
    </div>

    <script>
        // Función para cargar los comentarios almacenados
        function cargarComentarios() {
            const lista = document.getElementById('listaComentarios');
            const comentarios = JSON.parse(localStorage.getItem('comentarios')) || []; // Obtener los comentarios guardados
            comentarios.forEach(function(comentario, index) {
                mostrarComentario(comentario, index);
            });
        }

        // Función para agregar un comentario
        function agregarComentario() {
            const comentario = document.getElementById('comentario').value;
            if (comentario.trim() !== "") {
                // Obtener los comentarios almacenados
                const comentarios = JSON.parse(localStorage.getItem('comentarios')) || [];
                comentarios.push(comentario); // Agregar el nuevo comentario al array

                // Guardar los comentarios actualizados en localStorage
                localStorage.setItem('comentarios', JSON.stringify(comentarios));

                // Mostrar el nuevo comentario en la página
                mostrarComentario(comentario, comentarios.length - 1);

                // Limpiar el campo de texto
                document.getElementById('comentario').value = '';
            } else {
                alert('Por favor, escribe un comentario antes de enviarlo.');
            }
        }

        // Función para mostrar un comentario y agregar el botón de borrar
        function mostrarComentario(comentario, index) {
            const lista = document.getElementById('listaComentarios');
            const nuevoComentario = document.createElement('div');
            nuevoComentario.classList.add('comentario');
            
            const textoComentario = document.createElement('span');
            textoComentario.textContent = comentario;
            nuevoComentario.appendChild(textoComentario);
            
            // Crear el botón de eliminar
            const botonEliminar = document.createElement('button');
            botonEliminar.textContent = '❌';
            botonEliminar.classList.add('boton-eliminar');
            botonEliminar.onclick = function() {
                eliminarComentario(index);
            };
            nuevoComentario.appendChild(botonEliminar);

            lista.appendChild(nuevoComentario);
        }

        // Función para eliminar un comentario
        function eliminarComentario(index) {
            const comentarios = JSON.parse(localStorage.getItem('comentarios')) || [];
            comentarios.splice(index, 1); // Eliminar el comentario del array

            // Guardar los comentarios actualizados en localStorage
            localStorage.setItem('comentarios', JSON.stringify(comentarios));

            // Recargar los comentarios para reflejar el cambio
            cargarComentarios();
        }

        // Cargar los comentarios cuando la página se carga
        window.onload = cargarComentarios;
    </script>
</body>

