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
})()

