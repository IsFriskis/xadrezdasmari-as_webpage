# Tema WordPress - Xadrez das Mariñas

Tema oficial do Club Xadrez das Mariñas para WordPress.

## Instalación

1. **Subir o tema**: Descarga a carpeta `xdm-theme` e súbea ao directorio `/wp-content/themes/` do teu WordPress.

2. **Activar o tema**: Vai a **Aparencia → Temas** no panel de administración e activa "Xadrez das Mariñas".

3. **Configurar os menús**: Vai a **Aparencia → Menús** e crea os seguintes menús:
   - **Menú Principal** (`main`): O menú de navegación principal con soporte para submenús
   - **Menú do Pé de Páxina** (`footer`): Ligazóns que aparecen no rodapé
   - **Menú Legal** (`footer-legal`): Ligazóns legais (privacidade, cookies, etc.)

4. **Configurar o logo**: Vai a **Aparencia → Personalizar → Identidade do sitio** e sube o logo.

5. **Configurar o Hero**: Vai a **Aparencia → Personalizar → Sección Hero** para personalizar o título, subtítulo e imaxe.

6. **Configurar as redes sociais**: Vai a **Aparencia → Personalizar → Redes Sociais** e engade as túas URLs.

## Estrutura de Menús Recomendada

Baseado na túa configuración actual:

### Menú Principal
- **Novas** (Categoría)
  - Novas
  - Club
  - Escola
  - Xogade
  - Liga
  - Torneos
- **O club** (Páxina)
- **Escola** (Páxina)
  - Escola
  - Leccións
- **Xogade** (Páxina)
  - Actividades en XOGADE
  - Novas
- **Contacto** (Páxina)

### Menú Footer
- Inicio
- Torneos
- Clases
- Blog
- Sobre Nós
- Contacto

### Menú Legal
- Privacidade
- Aviso Legal
- Cookies

## Categorías Recomendadas

O tema está deseñado para funcionar coas seguintes categorías:
- `novas` - Noticias xerais
- `club` - Información do club
- `escola` - Contido educativo
- `liga` - Información da liga
- `torneos` - Torneos e competicións
- `xogade` - Actividades XOGADE
- `leccions` - Leccións e titoriais

## Widgets

O tema inclúe as seguintes áreas de widgets:
- **Barra Lateral**: Aparece en publicacións e páxinas de arquivo
- **Pé de Páxina 1 e 2**: Columnas adicionais no rodapé

## Plantillas de Páxina

- **Páxina por Defecto**: Páxina estándar con barra lateral
- **Páxina Ancho Completo**: Sen barra lateral
- **Páxina de Contacto**: Incluye tarxetas de información de contacto

## Personalización do Tema

### Cores
As cores principais están definidas como variables CSS en `style.css`:
```css
--color-primary: #1e6f3e;    /* Verde escuro */
--color-secondary: #155a2e;  /* Verde máis escuro */
--color-accent: #2d8f52;     /* Verde acento */
```

### Imaxes
Coloca as seguintes imaxes na carpeta `/assets/`:
- `logo.png` - Logo do club (usarase se non hai logo personalizado)
- `hero.jpg` - Imaxe de fondo do hero (usarase se non se configura no personalizador)
- `xogade.jpg` - Imaxe para o widget de XOGADE

## Requisitos

- WordPress 5.0 ou superior
- PHP 7.4 ou superior

## Screenshot

Para que o tema apareza cun preview no panel de administración, engade unha imaxe chamada `screenshot.png` (880×660 píxeles) na raíz da carpeta do tema.

## Soporte

Para soporte ou suxestións, contacta con Xadrez das Mariñas.

---

© 2024 Xadrez das Mariñas
