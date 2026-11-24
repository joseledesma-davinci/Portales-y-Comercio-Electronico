@if ($paginator->hasPages())
    <!-- PAGINADOR-PROPIO-V2 -->
    {{-- Paginador propio del sitio: evita la vista Tailwind por defecto de Laravel y usa clases del proyecto. --}}
    {{-- Texto en español DIRECTO (sin __('...')): así funciona aunque el locale del .env no esté configurado. --}}
    <nav aria-label="Paginación">
        <ul class="pagination">
            {{-- Botón Anterior --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="pagination__link is-disabled" aria-disabled="true">Anterior</span>
                </li>
            @else
                <li>
                    <a class="pagination__link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Anterior</a>
                </li>
            @endif

            {{-- Números de página y separadores --}}
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

            {{-- Botón Siguiente --}}
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

        {{-- Resumen de qué tramo de datos está viendo el usuario (útil para explicar en el oral). --}}
        <p class="pagination__summary">
            Mostrando {{ $paginator->firstItem() }} a {{ $paginator->lastItem() }} de {{ $paginator->total() }} publicaciones
        </p>
    </nav>
@endif
