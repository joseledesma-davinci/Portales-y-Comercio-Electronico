@if ($paginator->hasPages())
    <!-- PAGINADOR-PROPIO-V2 -->
    {{-- Paginador del panel admin: misma lógica que el del sitio, separado para mantener control visual por contexto. --}}
    {{-- Texto en español DIRECTO (sin __('...')): así funciona aunque el locale del .env no esté configurado. --}}
    <nav aria-label="Paginación">
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li>
                    <span class="pagination__link is-disabled" aria-disabled="true">Anterior</span>
                </li>
            @else
                <li>
                    <a class="pagination__link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Anterior</a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li>
                        <span class="pagination__link is-disabled" aria-disabled="true">{{ $element === '...' ? '…' : $element }}</span>
                    </li>
                @elseif (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span class="pagination__link is-active" aria-current="page">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a class="pagination__link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li>
                    <a class="pagination__link" href="{{ $paginator->nextPageUrl() }}" rel="next">Siguiente</a>
                </li>
            @else
                <li>
                    <span class="pagination__link is-disabled" aria-disabled="true">Siguiente</span>
                </li>
            @endif
        </ul>

        <p class="pagination__summary">
            Mostrando {{ $paginator->firstItem() }} a {{ $paginator->lastItem() }} de {{ $paginator->total() }} publicaciones
        </p>
    </nav>
@endif
