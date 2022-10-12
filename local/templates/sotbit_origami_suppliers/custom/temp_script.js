// File input
class File {
  constructor($wrapper) {
    this.$wrapper = $wrapper
    this.type = $wrapper.dataset.file
    if (this.type !== 'images') throw new Error('только images... пока что...')

    this.input = $wrapper.querySelector('.file__input')
    this.multiple = this.input.hasAttribute('multiple')
    if (this.multiple) throw new Error('multiple не поддерживается... пока что...')

    this.$box = $wrapper.querySelector('.file__box')
    this.$boxEmpty = $wrapper.querySelector('.file__box-empty')
    this.$boxLoaded = $wrapper.querySelector('.file__box-loaded')
    this.$image = $wrapper.querySelector('.file__image')
    this.$deleteButton = $wrapper.querySelector('.file__delete')

    this.reader = new FileReader();
    // this.loaded = false

    // console.log(this)
    this.init()
  }

  init() {
    if (this.$image.src !== location.href) {
      this.$box.classList.add('loaded')
      this.$boxEmpty.style.display = 'none';
      this.$boxLoaded.style.display = '';
    }

    this.input.addEventListener('change', this.onInputChangeHandler.bind(this))
    this.reader.addEventListener('load', this.changeImage.bind(this))
    this.$deleteButton.addEventListener('click', this.deleteFile.bind(this))
  }

  onInputChangeHandler(e) {
    if (e.target.files && e.target.files[0]) {
      const file = e.target.files[0]
      this.reader.readAsDataURL(file);
      this.$box.classList.add('loaded')
      this.$boxEmpty.style.display = 'none';
      this.$boxLoaded.style.display = '';
    } else {
      this.$box.classList.remove('loaded')
      this.$boxEmpty.style.display = '';
      this.$boxLoaded.style.display = 'none';

      // Кастом для Леши
      this.$wrapper.querySelector('.delete-flag').checked = true
    }
  }

  changeImage(e, img = null) {
    if (e.target.result) {
      this.$image.src = e.target.result
    }
  }

  deleteFile(e) {
    e.preventDefault()
    this.input.value = ''
    this.onInputChangeHandler(e)
  }
}

const $files = document.querySelectorAll('[data-file]')

$files.length && $files.forEach($file => new File($file))

// Iframe video
const $iframeInputs = document.querySelectorAll('[data-iframe="textarea"]')
const $iframeIWrapper = document.querySelectorAll('[data-iframe="wrapper"]')

if ($iframeInputs.length !== $iframeIWrapper.length) throw new Error('Ты шо, лох?')

$iframeInputs.forEach(($iframeInput, index) => {
  $iframeInput.addEventListener('change', iframeInputsChangeHandler.bind(index))
  window.addEventListener('load', iframeInputsChangeHandler.bind(index))
})

function iframeInputsChangeHandler(e) {
  let value = e.target.value

  if (e.type === 'load') value = $iframeInputs[this].value

  const index = this
  const isTag = /<\/?[a-z][\s\S]*>/i

  if (!isTag.test(value)) {
    return $iframeIWrapper[index].innerText = ''
  }

  const html = parseStringToHTML(value)
  const $iframe = html.querySelector('iframe')
  const src = $iframe.getAttribute('src')

  if (src.includes('https://www.youtube.com/embed/')) {
    return $iframeIWrapper[index].append($iframe)
  } else {
    return $iframeIWrapper[index].innerText = ''
  }
}

function parseStringToHTML(string) {
  const parser = new DOMParser();
  return htmlDoc = parser.parseFromString(string, 'text/html');
}