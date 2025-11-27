<footer class="py-5 mt-auto">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-start mb-4 mb-md-0">
                <h5 class="mb-3">
                    <img src="{{ asset('img/logo.png') }}" alt="Slofy.Dev" height="30" class="me-2" style="background-color: white; border-radius: 30px; padding: 3px;">
                    Slofy.dev
                </h5>
                <p class="text-white-50 mb-3">Conectando talento à oportunidade.</p>
                <div class="mt-3">
                    <a href="mailto:contato@slofy.dev" class="text-white-50 text-decoration-none">
                        <small>slofy.dev@gmail.com</small>
                    </a>
                </div>
            </div>

            <div class="col-6 col-md-3 text-start mb-4 mb-md-0">
                <h6 class="text-uppercase mb-3">Navegação</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/') }}" class="text-white-50 text-decoration-none">Home</a></li>
                    <li><a href="{{ url('/sobre') }}" class="text-white-50 text-decoration-none">Sobre</a></li>
                    <li><a href="{{ url('/freelancers') }}" class="text-white-50 text-decoration-none">Freelancers</a></li>
                </ul>
            </div>

            <div class="col-6 col-md-3 text-start">
                <h6 class="text-uppercase mb-3">Legal</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/politica') }}" class="text-white-50 text-decoration-none">Política de Privacidade</a></li>
                    <li><a href="{{ url('/termos') }}" class="text-white-50 text-decoration-none">Termos de Uso</a></li>
                    <li><a href="{{ url('/contato') }}" class="text-white-50 text-decoration-none">Contato & Suporte</a></li>
                </ul>
            </div>
        </div>

        <hr class="mt-4 mb-3 opacity-25">

        <div class="text-center">
            <small class="text-white-50">&copy; {{ date('Y') }} Slofy.dev - Desenvolvido com profissionalismo</small>
        </div>
    </div>
</footer>