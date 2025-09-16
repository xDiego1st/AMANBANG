// $(function () {
//     // Show the time
//     showTime()
// })

// function showTime () {
//     var date = new Date()
//     var hours = date.getHours()
//     var minutes = date.getMinutes()
//     var seconds = date.getSeconds()
//     var session = hours >= 12 ? 'pm' : 'am'
//     hours = hours % 12
//     hours = hours ? hours : 12
//     minutes = minutes < 10 ? '0' + minutes : minutes
//     seconds = seconds < 10 ? '0' + seconds : seconds
//     var time = hours + ':' + minutes + ':' + seconds + ' ' + session
//     document.getElementById('liveClock').innerText = time
//     document.getElementById('liveClock').textContent = time
//     setTimeout(showTime, 1000)
// }
// Fungsi untuk toggle dark mode
function toggleDarkMode() {
    var darkMode = document.body.classList.toggle("dark-mode");
    // Simpan status dark mode dalam session
    sessionStorage.setItem("darkMode", darkMode ? "on" : "off");
    // Muat ulang halaman
    location.reload();
}

// Set dark mode saat halaman dimuat berdasarkan session
window.onload = function () {
    var darkMode = sessionStorage.getItem("darkMode");
    if (darkMode === "on") {
        document.body.classList.add("dark-mode");
    }
};

function isNumberKey(evt) {
    var charCode = evt.which ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
    return true;
}

function formatPhoneNumber(input) {
    let phoneNumber = input.value.replace(/\D/g, ""); // Menghapus karakter selain angka

    // Pisahkan nomor menjadi grup setiap 4 digit dan tambahkan "-"
    let formattedNumber = phoneNumber.match(/.{1,4}/g).join("-");

    // Setel nilai input dengan nomor yang telah diformat
    input.value = formattedNumber;
}

window.addEventListener("swal:alert", (event) => {
    Swal.fire({
        position: event.detail.position,
        title: event.detail.title,
        text: event.detail.text,
        icon: event.detail.icon,
        showConfirmButton: event.detail.showConfirmButton ?? false,
        showCancelButton: event.detail.showCancelButton ?? false,
        cancelButtonText: event.detail.cancelButtonText ?? "No",
        confirmButtonText: event.detail.confirmButtonText ?? "Yes",
        timer: event.detail.timer ?? null,
        timerProgressBar: true, // Tampilkan progress bar selama timer berjalan
    }).then((result) => {
        if (result.value) {
            if (event.detail.emitEvent && event.detail.data) {
                Livewire.dispatch(event.detail.emitEvent, {
                    data: event.detail.data,
                });
            } else if (event.detail.emitEvent) {
                Livewire.dispatch(event.detail.emitEvent);
            }
        }
    });
});

window.addEventListener("alert:message", (event) => {
    toastr.clear();
    // Tampilkan toast dengan judul dan pesan yang diberikan
    NioApp.Toast(
        `<h5>${event.detail.title}</h5><p>${event.detail.message}</p>`,
        event.detail.type
    );
});

window.addEventListener("resetSelect", (event) => {
    $(".js-select2").val(null).trigger("change"); // Ganti .js-select2 dengan kelas yang Anda gunakan untuk elemen select
});

window.addEventListener("refreshDynamicSelectbox", (event) => {
    const options = event.detail.options; // Mendapatkan data jabatan dari event detail
    const selectboxId = event.detail.selectboxId; // Mendapatkan ID selectbox dari event detail
    const textContentKey = event.detail.textContent; // Mendapatkan kunci untuk mengakses teks dinamis

    // Merefresh selectbox dengan ID yang diberikan
    const Selectbox = document.getElementById(selectboxId);

    // Hapus opsi-opsi yang ada
    Selectbox.innerHTML = "";

    const option = document.createElement("option");
    option.value = "";
    option.textContent = "Select Option";
    Selectbox.appendChild(option);

    // Tambahkan opsi-opsi baru berdasarkan data jabatan yang diperoleh dari Livewire
    options.forEach((data) => {
        const option = document.createElement("option");
        option.value = data.id;
        option.textContent = data[textContentKey]; // Isi opsi dengan teks dinamis
        Selectbox.appendChild(option);
    });

    // Refresh Select2 (jika Anda menggunakan Select2)
    $("#" + selectboxId).trigger("change.select2");
});

// function setSelectBox(selectId, selectModel) {
//     var selectBox = document.getElementById(selectId);
//     var userInput = selectBox.options[selectBox.selectedIndex].value;
//     // @this.set(selectModel, userInput)
//     //sesuaikan parameter dengan function setproperty livewire
//     Livewire.dispatch("setProperty", {
//         property: selectModel,
//         value: userInput,
//     });
//     return true;
// }
// Fungsi dinamis untuk set value select (single/multiple) ke property Livewire
function setSelectBox(selectId, livewireModel, defer = true) {
    let selectBox = document.getElementById(selectId);
    let userInput;

    if (selectBox.multiple) {
        // Ambil semua value yang terseleksi dalam bentuk array
        userInput = Array.from(selectBox.selectedOptions).map(option => option.value);
    } else {
        // Ambil single value
        userInput = selectBox.options[selectBox.selectedIndex].value;
    }

    // Cari komponen Livewire terdekat
    let component = Livewire.find(
        selectBox.closest('[wire\\:id]').getAttribute('wire:id')
    );

    // Set property ke Livewire dengan opsi defer
    component.set(livewireModel, userInput, defer);

    console.log("Property Livewire [" + livewireModel + "] di-set ke:", userInput, " | defer:", defer);

    return true;
}

window.addEventListener("selectOption", (customEvent) => {
    const selectId = customEvent.detail.selectId;
    const selectedValue = customEvent.detail.selectedValue;

    const selectElement = document.getElementById(selectId);
    if (selectElement) {
        selectElement.value = selectedValue;
        //     // Memicu peristiwa change pada elemen select
        const changeEvent = new Event("change", { bubbles: true });
        selectElement.dispatchEvent(changeEvent);
    } else {
        alert("Elemen dengan ID tersebut tidak ditemukan.");
    }
});

window.addEventListener("clearFileInputs", function () {
    let fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach((input) => {
        input.value = "";
    });
});

window.addEventListener("focus-accordion-item", function (event) {
    const itemId = event.detail.itemId;
    focusAccordionItem(itemId);
});

function focusAccordionItem(accordionItemId) {
    var accordionItem = document.getElementById(accordionItemId);
    if (accordionItem) {
        // Hapus kelas focused dari elemen sebelumnya (jika ada)
        var focusedElements = document.querySelectorAll(".focused");
        focusedElements.forEach(function (element) {
            element.classList.remove("focused");
        });

        // Tambahkan kelas focused ke elemen yang difokuskan
        accordionItem.classList.add("focused");

        // // Buka item jika belum terbuka
        // if (!accordionItem.classList.contains('show')) {
        //     var accordionToggle = accordionItem.querySelector('.accordion-head');
        //     accordionToggle.click();
        // }

        // Beri fokus ke accordion item
        // accordionItem.scrollIntoView({
        //     behavior: 'smooth',
        //     block: 'start'
        // });

        // Hapus kelas focused setelah 3 detik (3000 ms)
        setTimeout(function () {
            accordionItem.classList.remove("focused");
        }, 3000);
    }
}
window.addEventListener("open-modal", (event) => {
    const targetId = event.detail.targetId; // Mendapatkan id modal dari detail event
    const modalElement = document.getElementById(targetId); // Mendapatkan elemen modal berdasarkan id

    if (modalElement) {
        $(modalElement).modal("show"); // Menyembunyikan modal jika ditemukan
    }
});

window.addEventListener("close-modal", (event) => {
    const targetId = event.detail.targetId; // Mendapatkan id modal dari detail event
    const modalElement = document.getElementById(targetId); // Mendapatkan elemen modal berdasarkan id

    if (modalElement) {
        $(modalElement).modal("hide"); // Menyembunyikan modal jika ditemukan
    }
});

document.addEventListener('livewire:initialized', () => {
    const modalCache = {};
    const getModal = (id) => (modalCache[id] ??= new bootstrap.Modal(document.getElementById(id)));

    // terima ID modal dari Livewire
    Livewire.on('open-modal', (idOrObj) => {
        const id = typeof idOrObj === 'string' ? idOrObj : (idOrObj?.id ?? '');
        if (id) getModal(id).show();
    });

    Livewire.on('close-modal', (idOrObj) => {
        const id = typeof idOrObj === 'string' ? idOrObj : (idOrObj?.id ?? '');
        if (id) getModal(id).hide();
    });
});

$(document).ready(function () {
    // Tangkap event ketika suatu modal ditutup
    $("body").on("hidden.bs.modal", ".modal", function () {
        // Periksa apakah semua modals telah tertutup
        if ($(".modal:visible").length === 0) {
            // Memancarkan event Livewire ketika semua modals tertutup
            Livewire.dispatch("TriggerWhenClosedModals");
        }
    });
});

//memfungsikan select 2 di modals
$(document).ready(function () {
    // Fungsi untuk menginisialisasi select2 pada elemen di dalam modal
    function initializeSelect2(modal) {
        modal.find("select.js-select2").each(function () {
            var selectElement = $(this);
            selectElement.select2({
                dropdownParent: modal,
            });
        });
    }

    // Inisialisasi select2 pada modal saat pertama kali dibuka
    $(".modal").on("shown.bs.modal", function () {
        var modal = $(this);
        initializeSelect2(modal);
    });

    // Jika ada modal yang dibuka setelah Livewire memperbarui DOM
    Livewire.hook("message.processed", (message, component) => {
        $(".modal").each(function () {
            var modal = $(this);
            if (modal.hasClass("show")) {
                initializeSelect2(modal);
            }
        });
    });
});
//memfungsikan select 2 di moda;----------------------------
window.addEventListener("open-tab", (event) => {
    window.open(event.detail.url, "_blank");
});
