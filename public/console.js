$(function() {
  var inputField = $('input')

  $('form').submit(function(evt) {
    evt.preventDefault()

    if (input_locked()) {
      return
    }

    lock_input()

    var input = $('input').val()
    if (input == "/clear") {
      reset_input()
      return clear_screen()
    }

    $.post('/roll', {
      roll: input
    }, function(data) {
      var lineTag = $('<div>')
      lineTag.addClass('Line')

      var inputTag = $('<div>')
      inputTag.addClass('prompt input')
      inputTag.text(input)
      lineTag.append(inputTag)

      var outputTag = $('<div>')
      if (data.error) {
        outputTag.addClass('prompt output response error')
        var errorTag = $('<div>')
        errorTag.addClass('type error')
        errorTag.text(data.error)
        outputTag.append(errorTag)
        lineTag.append(outputTag)
      } else if (!data.intermediate) {
        // do nothing

      } else {
        outputTag.addClass('prompt output log')
        outputTag.text(data.intermediate + " = " + data.result)
        lineTag.append(outputTag)
      }

      $('.console-container').append(lineTag)
      reset_input()

    }, 'json')
  })

  var lock_input = function() {
    inputField.attr('readonly', true)
    return inputField.val()
  }

  var reset_input = function() {
    inputField.val('')
    inputField.attr('readonly', false)
  }

  var input_locked = function() {
    return inputField.attr('readonly')
  }

  var clear_screen = function() {
    $('.Line').not(':first').remove()
  }
})
