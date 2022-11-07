$(document).ready(function () {
  var windowsize = $(window).width()

  $(window).resize(function () {
    windowsize = $(window).width()
    if (windowsize < 720) {
      $('.sidebar-item-button').show()
      $('#sidebar').addClass('active-sidebar')
      $('.sidebar-item').show()
      $('#sidebar-content').css({ width: '16rem' })
      $('#main-content').css({ 'padding-left': '0px' })
    } else {
      $('.sidebar-item-button').show()
      $('#sidebar').addClass('active-sidebar')
      $('.sidebar-item').show()
      $('#sidebar-content').css({ width: '16rem' })
      $('#main-content').css({ 'padding-left': '16rem' })
      var buttonMobile = $('#sidebar')
      if (!buttonMobile.hasClass('-translate-x-64')) {
        buttonMobile.addClass('-translate-x-64')
        $('#blackopa').hide()
      }
    }
  })
  $('.btn-dropdown').on('click', function () {
    var dropdown = $(this)
    dropdown.parent().find('.item-dropdown').animate(
      {
        height: 'toggle',
      },
      300,
    )
    if (dropdown.find('#arrow-dropdown').hasClass('flip')) {
      dropdown.find('#arrow-dropdown').removeClass('flip')
      return
    }
    dropdown.find('#arrow-dropdown').addClass('flip')
  })
  $('.alat-hover').hover(
    function () {
      $(this)
        .find('ul')
        .css({ visibility: 'visible', opacity: 0.0 })
        .animate({ opacity: 1.0 }, 100)
    },
    function () {
      $(this)
        .find('ul')
        .animate({ opacity: 0.0 }, 10, function () {
          $(this).find('ul').css('visibility', 'hidden')
        })
    },
  )
  $('#sidebar-mobile-button').on('click', function () {
    var buttonMobile = $('#sidebar')
    if (buttonMobile.hasClass('-translate-x-64')) {
      buttonMobile.removeClass('-translate-x-64')
      $('#blackopa').show()
    }
  })
  $('#blackopa').on('click', function () {
    var buttonMobile = $('#sidebar')
    if (!buttonMobile.hasClass('-translate-x-64')) {
      buttonMobile.addClass('-translate-x-64')
      $('#blackopa').hide()
    }
  })
  $('.sidebar-item-button').on('click', function () {
    var button = $(this)
    if ($('#sidebar').hasClass('active-sidebar')) {
      button.hide()
      $('#sidebar').removeClass('active-sidebar')
      $('.sidebar-item').hide()
      $('#sidebar-content').css({ width: 'fit-content' })
      $('#main-content').css({ 'padding-left': '4rem' })
      $('.item-dropdown').css({ display: 'none' })
    } else {
      button.show()
      $('#sidebar').addClass('active-sidebar')
      $('.sidebar-item').show()
      $('#sidebar-content').css({ width: '16rem' })
      $('#main-content').css({ 'padding-left': '16rem' })
    }
  })
  $('#sidebar').hover(
    function () {
      if (!$(this).hasClass('active-sidebar')) {
        $('.sidebar-item').show()
        $('.sidebar-item-button').show()
        $('#sidebar-content').css({ width: '16rem' })
        if ($('.btn-dropdown').find('#arrow-dropdown').hasClass('flip')) {
          $('.item-dropdown').css({ display: 'block' })
        }
      }
    },
    function () {
      if (!$(this).hasClass('active-sidebar')) {
        $('.sidebar-item').hide()
        $('.sidebar-item-button').hide()
        $('#sidebar-content').css({ width: 'fit-content' })
        $('.item-dropdown').css({ display: 'none' })
      }
    },
  )
  $('#profile-button').on('click', function () {
    $('#profile-content').animate({ height: 'toggle' }, 300)
    $('#notification-content').hide()
    $('#searchPanel').hide()
  })
  $('#search-button').on('click', function () {
    var searchPanel = $('#searchPanel')
    $('#profile-content').hide()
    $('#notification-content').hide()
    searchPanel.animate({ height: 'toggle' }, 300)
    searchPanel.find('ul li').remove()
  })
  $('#notification-button').on('click', function () {
    $('#notification-content').animate({ height: 'toggle' }, 300)
    $('#profile-content').hide()
    $('#searchPanel').hide()
  })
  $('#alert button').on('click', function () {
    $(this).parent().remove()
  })
  $('#modal-tambah-jadwal-close').on('click', function () {
    $('#modal-tambah-jadwal').hide()
  })
  $('#show-modal-tambah-jadwal').on('click', function () {
    $('#modal-tambah-jadwal').show()
  })
  $('#modal-sudah-terkalibrasi-close').on('click', function () {
    $('#modal-sudah-terkalibrasi').hide()
  })
  $('#show-modal-sudah-terkalibrasi').on('click', function () {
    $('#modal-sudah-terkalibrasi').show()
  })
  $('#show-modal-hapus-alat').on('click', function () {
    var modal = $('#modal-hapus-alat')
    modal.show()
    modal.find('a').attr('href', '/dashboard/alat/hapus/' + $(this).data('id'))
  })
  $('#modal-hapus-alat-close').on('click', function () {
    $('#modal-hapus-alat').hide()
  })
  $('#show-modal-file-manager').on('click', function () {
    $('#modal-file-manager').show()
  })
  $('#modal-file-manager-close').on('click', function () {
    $('#modal-file-manager').hide()
  })
  $('#show-modal-tambah-user').on('click', function () {
    $('#modal-tambah-user').show()
  })
  $('#modal-tambah-user-close').on('click', function () {
    $('#modal-tambah-user').hide()
  })
  $('.uploadSertifikat').on('click', function () {
    var uploadSertifikat = $(this)
    var modal = $('#modal-upload-sertifikat')
    modal.find('#idForm').val(uploadSertifikat.attr('data-id'))
    modal
      .find('#title')
      .text(
        'Upload Sertifikat Kalibrasi Pada Tanggal ' +
          uploadSertifikat.attr('data-tanggal'),
      )
    modal.show()
  })
  $('#modal-upload-sertifikat-close').on('click', function () {
    var modal = $('#modal-upload-sertifikat')
    modal.find('#idForm').val()
    modal.find('#title').text('Upload Sertifikat Kalibrasi Pada Tanggal')
    modal.hide()
  })
  $('.searchForm').on('input', function () {
    $('#notification-content').hide()
    $('#profile-content').hide()
    var search = $(this)
    if (search.val().length < 1) {
      $('#searchPanel').find('ul li').remove()
      return
    }
    $.ajax({
      url: '/api/search',
      type: 'get',
      data: { search: search.val() },
      success: function (resp) {
        var searchPanel = $('#searchPanel')
        searchPanel.find('ul li').remove()
        if (resp.length < 1) {
          return
        }
        searchPanel.show()
        $.each(resp, function (key, value) {
          var item = $(
            '<li><a class="flex gap-2 px-4 py-2 rounded-md hover:bg-gray-100 font-medium text-gray-600 hover:font-normal hover:text-gray-700"href="/dashboard/alat/' +
              value.id +
              '"><svg class="w-5 fill-current" xmlns="http://www.w3.org/2000/svg"viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none" /><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" /></svg>' +
              value.nama_alat +
              '</a></li>',
          )
          searchPanel.find('ul').append(item)
        })
      },
    })
  })
  $('#showCalculateForm').on('click', function () {
    $(this).hide()
    $('#calculatePanel').show()
  })
  $('#calculateButton').on('click', function () {
    var jadwalKalibrasi = $('#jadwalKalibrasiForm')
    var tambahBulan = new Date()
    var kalkulateForm = $('#calculateForm')
    if (jadwalKalibrasi.val().length > 0) {
      tambahBulan = new Date(jadwalKalibrasi.val())
    }
    if (kalkulateForm.val() == 0) {
      return
    }
    tambahBulan.setMonth(
      parseInt(tambahBulan.getMonth()) + parseInt(kalkulateForm.val()),
    )
    jadwalKalibrasi.val($.date(tambahBulan))
    kalkulateForm.val(0)
    $('#calculatePanel').hide()
    $('#showCalculateForm').show()
  })
})
$.date = function (orginaldate) {
  var date = new Date(orginaldate)
  var day = date.getDate()
  var month = date.getMonth() + 1
  var year = date.getFullYear()
  if (day < 10) {
    day = '0' + day
  }
  if (month < 10) {
    month = '0' + month
  }
  var date = year + '-' + month + '-' + day
  return date
}

function notificationView(id, user_id) {
  var formdata = new FormData()
  formdata.append('user_id', user_id)
  var ajax = new XMLHttpRequest()
  ajax.open('POST', '/api/update-notification/' + id)
  ajax.send(formdata)
}
