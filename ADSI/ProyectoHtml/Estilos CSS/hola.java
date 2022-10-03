/* Desarrollar un programa que, dada una palabra, divida todos sus caracteres y
   los almacene en las posiciones de un vector del tamaño de la palabra, por 
   ejemplo: 
   - “Colombia”, tiene 8 palabras, por ende, el vector debe ser de tamaño 8 
      para almacenar cada carácter.
 */
package Clase2;
import java.util.Scanner;
public class Ejercicio3 {
    public static void main(String []args)
    {
        String palabra=null;
        Scanner sc=new Scanner(System.in);
        System.out.println("Digite la palabra: ");
        palabra=sc.next(); //Captura la palabra sin espacios.
        char arreglo[]=new char [palabra.length()];
        System.out.println("\nLa palabra tiene "+palabra.length()+" carácteres.");
        for(int i=0;i<palabra.length();i++)
        {
            arreglo[i]=palabra.charAt(i);
            System.out.println(i+" = "+arreglo[i]);
        }
        
        
        
    }
}
