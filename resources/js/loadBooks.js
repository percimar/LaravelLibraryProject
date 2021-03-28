(async () => {
    if (window.location.pathname === "/") {
        let searchField = document.getElementById('searchBooks')
        let listener = searchField.addEventListener('keydown', send)

        async function send(event) {

            let books = await $.get('/books', {
                data: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }
            })

            let loadDiv = $('#loadBooks')
            loadDiv.text('')
            books.map(book => {
                if (book.title.indexOf(event.target.value) !== -1) {
                    // Book CSS under append
                    loadDiv.append(
                        `
                        <div class="grid-item">
                            ${book.title}
                        </div>
                        `
                    )
                } else {
                        `
                        <div class="grid-item">
                            ${book.title}
                        </div>
                        `
                }
            })
        }
    }

})()

