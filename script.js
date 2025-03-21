let selectedMaterials = [];

document.addEventListener("DOMContentLoaded", function () {
  const bodegaSelect = document.getElementById("bodega");
  const sucursalSelect = document.getElementById("sucursal");

  bodegaSelect.addEventListener("change", function () {
    const bodegaId = this.value;

    if (bodegaId) {
      fetch(`functions/getSucursales.php?bodega_id=${bodegaId}`)
        .then((response) => {
          if (!response.ok) {
            throw new Error("No se recibió respuesta");
          }
          return response.json();
        })
        .then((data) => {
          sucursalSelect.innerHTML = "<option value=''></option>";

          if (data.length === 0) {
            sucursalSelect.innerHTML =
              "<option value=''>No existen sucursales</option>";
            return;
          }

          data.forEach((sucursal) => {
            const option = document.createElement("option");
            option.value = sucursal.sucursal_id;
            option.textContent = sucursal.sucursal_nombre;
            sucursalSelect.appendChild(option);
          });
        })
        .catch((error) => {
          console.error("Error cargando sucursales:", error);
          sucursalSelect.innerHTML =
            "<option value=''>Error al cargar</option>";
        });
    } else {
      sucursalSelect.innerHTML = "<option value=''></option>";
    }
  });
});

document.getElementById("material").addEventListener("change", function (e) {
  const checkboxes = document.querySelectorAll(
    "#material input[type=checkbox]"
  );

  selectedMaterials = [];

  checkboxes.forEach(function (checkbox) {
    if (checkbox.checked) {
      selectedMaterials.push(Number(checkbox.value));
    }
  });
});

const form = document.getElementById("product-form");
form.addEventListener("submit", function (event) {
  event.preventDefault();

  const codigo = document.getElementById("codigo").value.toUpperCase();
  const codigoRegex = /^(?=.*[a-zA-Z])(?=.*\d).+$/;
  if (!codigo) {
    alert("El código del producto no puede estar en blanco.");
    return;
  } else if (!codigoRegex.test(codigo)) {
    alert("El código del producto debe contener letras y números");
    return;
  } else if (codigo.length < 5 || codigo.length > 15) {
    alert("El código del producto debe tener entre 5 y 15 caracteres.");
    return;
  } else {
    // CHECK DESDE BACKEND
    fetch(`functions/checkCodigoExistente.php?codigo=${codigo}`)
      .then((response) => response.json())
      .then((data) => {
        if (data.exists) {
          alert("El código del producto ya está registrado.");
          return;
        }
        // RESTO DE VALIDACIONES SI ES QUE EL CODIGO NO EXISTE EN EL BACKEND
        const nombre = document.getElementById("nombre").value;
        if (!nombre) {
          alert("El nombre del producto no puede estar en blanco.");
          return;
        } else if (nombre.length < 2 || nombre.length > 50) {
          alert("El nombre del producto debe tener entre 2 y 50 caracteres.");
          return;
        }

        const bodega = document.getElementById("bodega").value;
        if (!bodega) {
          alert("Debe seleccionar una bodega.");
          return;
        }

        const sucursal = document.getElementById("sucursal").value;
        if (!sucursal) {
          alert("Debe seleccionar una sucursal para la bodega seleccionada.");
          return;
        }

        const precio = document.getElementById("precio").value;
        const precioRegex = /^[+]?\d+(\.\d{1,2})?$/;
        if (!precio) {
          alert("El precio del producto no puede estar en blanco.");
          return;
        } else if (!precioRegex.test(precio)) {
          alert(
            "El precio del producto debe ser un número positivo con hasta dos decimales."
          );
          return;
        }

        if (selectedMaterials.length < 2) {
          alert("Debe seleccionar al menos dos materiales para el producto.");
          return;
        }

        const moneda = document.getElementById("moneda").value;
        if (!moneda) {
          alert("Debe seleccionar una moneda para el producto.");
          return;
        }

        const descripcion = document.getElementById("descripcion").value;
        if (!descripcion) {
          alert("La descripción del producto no puede estar en blanco.");
          return;
        } else if (descripcion.length < 10 || descripcion.length > 1000) {
          alert(
            "La descripción del producto debe tener entre 10 y 1000 caracteres."
          );
          return;
        }

        const formData = new FormData();
        formData.append("codigo", codigo.toUpperCase());
        formData.append("nombre", nombre);
        formData.append("bodega", bodega);
        formData.append("sucursal", sucursal);
        formData.append("moneda", moneda);
        formData.append("precio", precio);
        formData.append("descripcion", descripcion);
        formData.append("materiales", JSON.stringify(selectedMaterials));

        fetch("php/form_process.php", {
          method: "POST",
          body: formData,
        })
          .then((response) => response.text())
          .then((data) => alert(data))
          .catch((error) => console.error("Error:", error));

        form.reset();
      })
      .catch((error) => {
        console.error("Error al verificar el código:", error);
      });
  }
});
