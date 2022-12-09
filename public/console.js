// jQuery.fn.putCursorAtEnd = function() {
//   return this.each(function() {
//     $(this).focus()
//     // If this function exists...
//     if (this.setSelectionRange) {
//       // ... then use it (Doesn't work in IE)
//       // Double the length because Opera is inconsistent about whether a carriage return is one character or two. Sigh.
//       var len = $(this).val().length * 2;
//       this.setSelectionRange(len, len);
//     } else {
//       // ... otherwise replace the contents with itself
//       // (Doesn't work in Google Chrome)
//       $(this).val($(this).val());
//     }
//     // Scroll to the bottom, in case we're in a tall textarea
//     // (Necessary for Firefox and Google Chrome)
//     this.scrollTop = 999999;
//   });
// };

$(function() {
  var inputField = $('input')
  var inputDiv = $('.input')

  var history = []
  var history_at = 0
  var history_tmp

  inputField.keydown(function(evt) {
    if (evt.which == 38) {
      evt.preventDefault()
      prev_history()
    }
    else if (evt.which == 40) {
      evt.preventDefault()
      next_history()
    } else {
      history_at = 0
    }
  })

  $('form').submit(function(evt) {
    evt.preventDefault()

    var input = $('input').val()
    if (!input) return

    if (input_locked()) return
    lock_input()

    add_history(input)

    if (input == "/clear") {
      reset_input()
      return clear_screen()
    } else if (input == "/dark") {
      reset_input()
      $('body').toggleClass('theme-dark')
    }

    $.post('/roll', {
      roll: input
    }, function(data) {
      reset_input()
      
      if (data.error) {
        write(input, data.error, true)
      } else if (!data.intermediate) {
        write(input)
      } else {
        var output = data.intermediate + " = <b>" + data.result + "</b>"
        write(input, output)
      }

    }, 'json')
  })

  var write = function(input, output, is_error) {
    var inputIcon = $('<img>')
    inputIcon.attr('src', '/assets/in.svg')

    var lineTag = $('<div>')
    lineTag.addClass('line')

    var inputTag = $('<div>')
    inputTag.addClass('subline')
    inputTag.append(inputIcon)
    inputTag.append(input)
    lineTag.append(inputTag)

    if (output) {
      var outputTag = $('<div>')
      outputTag.addClass('subline')

      if (is_error) {
        outputTag.addClass('error')
      }

      outputTag.html(output)
      lineTag.append(outputTag)
    }

    $('.console-container').append(lineTag)
  }

  var lock_input = function() {
    inputDiv.find('img').hide()
    inputDiv.find('img.working').show()
    inputField.attr('readonly', true)
    return inputField.val()
  }

  var reset_input = function() {
    inputDiv.find('img').hide()
    inputDiv.find('img').not('.working').show()

    history_at = 0
    inputField.val('')
    inputField.attr('readonly', false)
    $('html, body').scrollTop($(document).height());
  }

  var input_locked = function() {
    return inputField.attr('readonly')
  }

  var clear_screen = function() {
    history_at = 0
    history = []
    $('.line').not('.howto').not('.input').remove()
  }

  var add_history = function(input) {
    var last = history.slice(-1)[0]
    if (last == input) return

    history.push(input)
  }

  var prev_history = function() {
    if (history_at == 0) {
      history_tmp = inputField.val()
    }

    history_at += 1
    if (history_at > history.length) {
      history_at = history.length
    }

    if (history_at > 0) {
      set_input(history.slice(-1 * history_at)[0])
    }
  }

  var next_history = function() {
    if (history_at == 0) return

    history_at -= 1
    if (history_at == 0) {
      set_input(history_tmp)
    } else {
      set_input(history.slice(-1 * history_at)[0])
    }
  }

  var set_input = function(value) {
    inputField.val(value)
    // inputField.focus().putCursorAtEnd()
  }
})
