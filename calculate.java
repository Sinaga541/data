import java.util.Stack;

class Solution {
    public static int calculate(String s) {
        Stack<Integer> stack = new Stack<Integer>();
        int result = 0, len = s.length(), number = 0;
        char operator = '+';
        
        if (s == null || len == 0) {
            return 0;
        }
        
        for (int i = 0; i < len; i++) {
            char cur_char = s.charAt(i);
            
            if (Character.isDigit(cur_char)) {
                number = number * 10 + (cur_char - '0');
            }
            if (!Character.isDigit(cur_char) && !Character.isWhitespace(cur_char) || i == len - 1) {
                if (operator == '+') {
                    stack.push(number);
                }
                else if (operator == '-') {
                    stack.push(-number);
                }
                else if (operator == '*') {
                    stack.push(stack.pop() * number);
                }
                else if (operator == '/') {
                    stack.push(stack.pop() / number);
                }
                number = 0;
                operator = cur_char;
            }
        }
        while (!stack.isEmpty()) {
            result += stack.pop();
        }
        return result;
    }

    public static void main(String[] args) {
        System.out.println(calculate("1 + 1"));
        System.out.println(calculate(" 2 + 2 "));
        System.out.println(calculate("20 / 2"));
        System.out.println(calculate("2 * 2"));
    }
}