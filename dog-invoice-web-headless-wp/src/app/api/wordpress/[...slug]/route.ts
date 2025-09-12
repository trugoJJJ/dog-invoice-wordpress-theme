import { NextRequest, NextResponse } from 'next/server'

// WordPress API URL - dostosuj do swojej instalacji
const WORDPRESS_API_URL = process.env.WORDPRESS_API_URL || 'http://localhost/wp-json/doginvoice/v1'

export async function GET(
  request: NextRequest,
  { params }: { params: { slug: string[] } }
) {
  try {
    const slug = params.slug.join('/')
    const url = `${WORDPRESS_API_URL}/${slug}`
    
    console.log('Proxying request to:', url)
    
    const response = await fetch(url, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      },
      // Dodaj timeout dla lepszej obsługi błędów
      signal: AbortSignal.timeout(10000) // 10 sekund timeout
    })

    if (!response.ok) {
      console.error('WordPress API error:', response.status, response.statusText)
      
      // Zwróć bardziej szczegółowe informacje o błędzie
      let errorMessage = `WordPress API error: ${response.status} ${response.statusText}`
      
      if (response.status === 404) {
        errorMessage += ` - Endpoint /${slug} not found. Check if WordPress REST API is working.`
      } else if (response.status >= 500) {
        errorMessage += ` - WordPress server error. Check WordPress installation.`
      }
      
      return NextResponse.json(
        { error: errorMessage, url: url },
        { status: response.status }
      )
    }

    const data = await response.json()
    console.log(`WordPress API /${slug} response:`, data)

    return NextResponse.json(data)
  } catch (error) {
    console.error('Proxy error:', error)
    
    let errorMessage = 'Failed to fetch from WordPress API'
    
    if (error instanceof Error) {
      if (error.name === 'TimeoutError') {
        errorMessage += ' - Request timeout. Check WordPress server.'
      } else if (error.message.includes('ECONNREFUSED')) {
        errorMessage += ' - Connection refused. Check WordPress URL and server.'
      } else {
        errorMessage += ` - ${error.message}`
      }
    }
    
    return NextResponse.json(
      { 
        error: errorMessage, 
        url: WORDPRESS_API_URL,
        details: error instanceof Error ? error.message : 'Unknown error'
      },
      { status: 500 }
    )
  }
}
