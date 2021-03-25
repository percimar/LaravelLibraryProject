(async()=>{
    if (window.location.pathname === "/") {
        let books = await $.get('/books',{
            data: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }
        })
    }
    // books.mpa
    // $('loadBooks').append(`
    //     <div class="card" >
    //         ${}
    //     </div>
    
    //     `)

})()

